<?php

namespace App\Http\ServicesLayer\BlogServices;

use App\Models\Blog;
use WebSocket\Client;
use App\Models\Lawyer;
use App\Models\LawyerPrices;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Http\ServicesLayer\WebSocketServices\WebSocketService;
use App\Jobs\SendFixedServicesChunk;
use App\Mail\FixedServicesNotification;
use Illuminate\Support\Facades\Mail;

class BlogService
{
    protected $model;
    protected $webSocketService;
    protected $notification;
    protected $lawyer_prices;
    protected $lawyer;


    public function __construct(Blog $model, Lawyer $lawyer, WebSocketService $webSocketService, Notification $notification, LawyerPrices $lawyer_prices)
    {
        $this->model = $model;
        $this->webSocketService = $webSocketService;
        $this->notification = $notification;
        $this->lawyer_prices = $lawyer_prices;
        $this->lawyer = $lawyer;
    }

    public function create($request, $translations, $auth, $added_by_type, $isPublish)
    {
        
        $model = $this->model->create($request);
        $model->is_publish = $isPublish;
        $model->added_by_type = $added_by_type;
        $translations['title_ar'] ? $model->translateOrNew('ar')->title = $translations['title_ar'] : '';
        $translations['content_ar'] ? $model->translateOrNew('ar')->content = $translations['content_ar'] : '';
        $translations['description_ar'] ? $model->translateOrNew('ar')->description = $translations['description_ar'] : '';
        $translations['title_en'] ? $model->translateOrNew('en')->title = $translations['title_en'] : '';
        $translations['content_en'] ? $model->translateOrNew('en')->content = $translations['content_en'] : '';
        $translations['description_en'] ? $model->translateOrNew('en')->description = $translations['description_en'] : '';
        $model->save();
        $auth->blogs()->save($model);

        if (isset($model->is_fixed_service) && (int)$model->is_fixed_service == 1) {
            $title = $model->title ?? $model->translations[0]->title;
            $data = [
                'type' => 'fixed_services_request',
                // 'price_secreen_route' => route('dashboard/blogs/cost', $model->encrypted_id),
                'price_secreen_route' => $model->price_secreen_route,
                'title' => "{$title} طلب عرض سعر لخدمه",
                'notification_type' => 1,
            ];
            $notification = $this->notification->create([
                'type' => 1,
                'is_read' => 1,
                'content' => "{$title} طلب عرض سعر لخدمه",
            ]);
            $model->notifications()->save($notification);
            
            // send notifications by gmail with queue
            $delayMinutes = 1;
            $this->lawyer->active()->unArchive()->chunk(50, function ($users) use($data, $delayMinutes) {
                dispatch(new SendFixedServicesChunk($users->toArray(), $data))->onQueue('send_fixed_service_mail')->delay(now()->addMinutes($delayMinutes));
                $delayMinutes += 2;
            });
            
            // send notifications by web socket
            $this->webSocketService->sendNotification(json_encode($data));
        }
        return $model;
    }

    public function update($id, $request, $translations)
    {
        $model = $this->model->find($id);
        $model->update($request);
        $translations['title_ar'] ? $model->translateOrNew('ar')->title = $translations['title_ar'] : '';
        $translations['content_ar'] ? $model->translateOrNew('ar')->content = $translations['content_ar'] : '';
        $translations['description_ar'] ? $model->translateOrNew('ar')->description = $translations['description_ar'] : '';
        $translations['title_en'] ? $model->translateOrNew('en')->title = $translations['title_en'] : '';
        $translations['content_en'] ? $model->translateOrNew('en')->content = $translations['content_en'] : '';
        $translations['description_en'] ? $model->translateOrNew('en')->description = $translations['description_en'] : '';
        return $model->save();
    }

    public function costUpdate($id, $request)
    {
        $price = DB::table('lawyer_prices')
                ->where('lawyer_id', auth()->guard('lawyer')->user()->id)
                ->where('blog_id', $id)
                ->first();

        if ($price) {
            $this->lawyer_prices->where('id', $price->id)->update([
                'price' => $request['price'],
            ]);
        }else{
            $price = $this->lawyer_prices->create([
                'blog_id' => $id,
                'lawyer_id' => auth()->guard('lawyer')->user()->id,
                'price' => $request['price'],
            ]);
        }
        return $price;
    }
}
