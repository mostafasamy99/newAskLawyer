<?php

namespace App\Http\ServicesLayer\Front\RequestServices;

use App\Models\Answer;
use App\Models\Blog;
use App\Models\LawyerPrices;
use App\Models\Message;
use App\Models\Request;
use DevxPackage\AbstractRepository;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;
use function React\Promise\all;

class RequestService extends AbstractRepository
{
    protected $model;
    protected $answer;
    protected $message;
    protected $blog;
    protected $lawyerPrices;

    public function __construct(Request $model, Answer $answer, Message $message, Blog $blog, LawyerPrices $lawyerPrices)
    {
        $this->model = $model;
        $this->answer = $answer;
        $this->message = $message;
        $this->blog = $blog;
        $this->lawyerPrices = $lawyerPrices;
    }

    public function crudName(): string
    {
        return 'requests';
    }

    public function store($request)
    {;
        try{
            if(!auth()->guard('web')->check() && (int)$request->service_id == 9 || (int)$request->service_id == 6) {
                flash()->error('must be logged in');
                return back();
            }
            if(auth()->guard('lawyer')->check() || auth()->guard('web')->check()) {
                $request['user_id'] = auth()->guard('lawyer')->check() ? auth()->guard('lawyer')->user()->id : auth()->guard('web')->user()->id;
            }
            $request = $this->handle_request($request);
            $this->model->create($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function storePaidServices($request, $service_id)
    {
        try {
            if(!auth()->guard('web')->check()) {
                flash()->error('must be logged in');
                return back();
            }
            $request['service_id'] = decrypt($service_id);
            $request['lawyer_id'] = !is_numeric($request['lawyer_id']) && !is_null($request['lawyer_id']) ? decrypt($request['lawyer_id']) : $request['lawyer_id'];
            if(is_null($request['message']) && isset($request['blog_id']) && !is_null($request['blog_id'])) {
                $request['blog_id'] = decrypt($request['blog_id']);
                $blog = $this->blog->find($request['blog_id']);
                if (!is_null($request['lawyer_id'])) {
                    $request['fixed_service_price'] = DB::table('lawyer_prices')
                    ->where('lawyer_id', $request['lawyer_id'])->where('blog_id', $request['blog_id'])
                    ->first()?->price;
                }
                $request['fixed_service_price'] = $request['fixed_service_price'] ?? $blog->price; 
                $title = $blog->title ?? $blog->translations[0]->title;
                $request['title'] = "خدمه ثابته : $title";
                $request['message'] = "خدمه ثابته : $title";
            }
            // $previous = explode('/', url()->previous());
            // $request['service_id'] = end($previous);
            if(isset($request->first_name) && !is_null($request->first_name)){
                $request->merge(['username' => $request->first_name .' '. $request->last_name ?? '']);
            }
            if (!$request->hasFile('user_files') == null) {
                $files = uploadIamges($request->file('user_files'), $this->crudName()); // function on helper file to upload file
                $request->merge(['files' => $files]);
            }
            $request['user_id'] = auth()->guard('web')->user()->id;
            $request = $this->handle_request($request);
            $this->model->create($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function confirm($request)
    {
        $requestRecord = $this->model->where('status', 0)->find($request->request_id);
        if (is_null($requestRecord) || !is_null($requestRecord->lawyer_id) && $requestRecord->lawyer_id != auth()->guard('lawyer')->user()->id) {
            return responseJson(404, 'not found');
        }
        $update_arr = array();
        if ((int)$request->service_id == 9) {
            $update_arr = [
                'status' => 1,
                'lawyer_id' => auth()->guard('lawyer')->user()->id
            ];
        } elseif ((int)$request->service_id == 6) {
            $this->answer->create([
                'cost' => $request->offer_price_cost,
                'content' => $request->offer_price_desc,
                'request_id' => $requestRecord->id,
                'lawyer_id' => auth()->guard('lawyer')->user()->id,
            ]);
            return responseJson(200, 'success');
        } else if ((int)$request->service_id == 8 || (int)$request->service_id == 10) {
            $update_arr = [
                'status' => $request->action_type,
                'lawyer_id' => auth()->guard('lawyer')->user()->id
            ];
        } elseif ((int)$request->service_id == 11) {
            $this->answer->create([
                'content' => $request->question_answer,
                'request_id' => $requestRecord->id,
                'lawyer_id' => auth()->guard('lawyer')->user()->id,
            ]);
            return responseJson(200, 'success');
        }
        $requestRecord->update($update_arr);
        return responseJson(200, 'success');
    }

    public function getRoom($request)
    {
        $messages = $this->message->whereRequest_id($request->request_id)->get()->toArray();
        // $messages = $this->message->with(['senderable', 'receiverable'])->whereRequest_id($request->request_id)->get()->toArray();
        return responseJson(200, 'success', $messages);
    }

    public function getAnswers($id)
    {
        $answers = $this->answer->whereRequest_id($id)->get()->toArray();
        return responseJson(200, 'success', $answers);
    }
}
