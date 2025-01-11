<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Lawyer;
use App\Traits\Front\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Report;
use App\Http\Repositories\Eloquent\Admin\LawyerRepository;
use App\Models\LawyerPrices;

class FrontController extends Controller
{
    use GeneralTrait;
    public $report;
    public $lawyer;
    public $blog;
    public $lawyerRepository;

    public function __construct(Report $report, Lawyer $lawyer, Blog $blog, LawyerRepository $lawyerRepository)
    {
        $this->report = $report;
        $this->lawyer = $lawyer;
        $this->blog = $blog;
        $this->lawyerRepository = $lawyerRepository;
    }

    public function home()
    {
        $data = $this->reportPage(['settings', 'our_blogs_home', 'lawyers_blogs_home', 'about_company', 'ask_lawyer', 'services']);
        return view('front.home', compact('data'));
    }

    public function abouts()
    {
        $data = $this->reportPage(['settings', 'sections_abouts', 'why_us_abouts']);
        return view('front.abouts', compact('data'));
    }

    public function howWorks()
    {
        $data = $this->reportPage(['settings']);
        return view('front.how_works', compact('data'));
    }

    public function userProcess()
    {
        $data = $this->reportPage(['settings', 'sections_user_process', 'why_us_abouts']);
        return view('front.user_process', compact('data'));
    }

    public function lawyersProcess()
    {
        $data = $this->reportPage(['settings', 'process.steps', 'why_us_abouts']);
        return view('front.lawyer_process', compact('data'));
    }

    public function blogs($type)
    {
        $relations = '';
        if ($type == 'our-blogs'){ $relations = 'our_blogs'; }
        elseif ($type == 'lawyers-blogs'){ $relations = 'lawyers_blogs'; }

        $data = $this->reportPage(['settings', $relations]);
        return view('front.blogs', compact('data', 'type'));
    }

    public function blog($id)
    {
        $data = $this->reportPage(['settings', 'blog' => function($query) use($id) {
            return $query->with('section')->find($id);
            // return $query->with(['section', 'related_blogs'])->find($id);
        }, ]);
        if ($data['blog'] && $data['blog']['section_id']) {
            $data['related_blogs'] = $this->blog->active()->unArchive()
                                    ->where('section_id', $data['blog']['section_id'])
                                    ->where('id', '!=', $data['blog']['id'])
                                    ->where('added_by_type', $data['blog']['added_by_type'])
                                    ->where('is_favorite', 1)->inRandomOrder()->limit(6)->get()->toArray();
        }
        return view('front.blog', compact('data'));
    }

    public function hireALawyer()
    {
        $data = $this->reportPage(['settings']);
        return view('front.hire_a_lawyer', compact('data'));
    }

    public function lawyers($page = 1)
    {
        $data = $this->reportPage(['settings', 'lawyers' => function($query) use($page) {
            $query->with(['country', 'city', 'languages', 'services', 'legal_fields'])
                ->when($page > 1, function ($ne) use($page) {
                    $ne->skip(PAGINATION_COUNT_FRONT * ($page - 1));
                })
                ->limit(PAGINATION_COUNT_FRONT);
        }], ['lawyers']);
        return view('front.lawyers', compact(['data', 'page']));
    }

    public function lawyer($id)
    {
        $data = $this->reportPage(['settings', 'services', 'lawyer' => function($query) use($id){
            $query->with(['country', 'city', 'languages', 'services', 'legal_fields', 'lawyer_prices.blog'])->find($id);
        }]);
        return view('front.lawyer_info', get_defined_vars());
    }

    public function lawyerApi($id)
    {
        return responseJson(200, "sucess", $this->lawyer->select('id', 'name', 'token')->find($id));
    }

    public function companies($page = 1)
    {
        $data = $this->reportPage(['settings', 'companies' => function($query) use($page) {
            $query->with(['country', 'city', 'languages', 'services', 'legal_fields'])
                ->when($page > 1, function ($ne) use($page) {
                    $ne->skip(PAGINATION_COUNT_FRONT * ($page - 1));
                })
                ->limit(PAGINATION_COUNT_FRONT);
        }], ['companies']);
        return view('front.companies', compact(['data', 'page']));
    }

    public function company($id)
    {
        $data = $this->reportPage(['settings', 'services', 'company' => function($query) use($id) {
            $query->with(['country', 'city', 'languages', 'services', 'legal_fields', 'lawyer_prices.blog'])->find($id);
        }]);
        return view('front.company_info', compact('data'));
    }

    public function fixedService($id, $lawyer_id = 0)
    {
        $data = $this->reportPage(['settings', 'blog' => function($query) use($id) {
            return $query->with(['section', 'prices.lawyer'])->find($id);
        }, ]);
        return view('front.fixed_service_details', get_defined_vars());
    }

    public function allService($id, $lawyer_id = 0){

        $data = $this->reportPage(['settings', 'service' => function($query) use($id) {
                return $query->with(['blogs'])->find($id);
            }, 'lawyer' => function($query) use($lawyer_id) {
                return $query->find($lawyer_id);
            }
        ]);
        if ($data['service']['id'] == 9 || $data['service']['id'] == 10 || $data['service']['id'] == 11) {
            return view('front.ask', compact('data'));
        }elseif ($data['service']['id'] == 6 || $data['service']['id'] == 8) {
            return view('front.ask_price_request', compact('data'));
        }
        $this->home();
    }


    public function privacyPolicy()
    {
        $data = $this->reportPage(['settings', 'privacy_policy']);
        return view('front.privacy_policy', compact('data'));
    }

    public function legalInfo()
    {
        $data = $this->reportPage(['settings', 'subjects']);
        return view('front.legal_info', compact('data'));
    }

    public function contact()
    {
        $data = $this->reportPage(['settings']);
        return view('front.contact', compact('data'));
    }

    public function subjects($id)
    {
        $data = $this->reportPage(['settings', 'subject' => function($query) use($id) {
            return $query->with(['blogs.translations'])->find($id);
        }]);
        return view('front.subjects', compact('data'));
    }

    public function services($id, $lawyer_id = 0, $blog_id = 0)
    {
        $data = $this->reportPage(['settings', 'blogs_fixed_service', 'service' => function($query) use($id) {
                return $query->with(['blogs'])->find($id);
            }, 'lawyer_or_company' => function($query) use($lawyer_id) {
                return $query->find($lawyer_id);
            }
        ]);
        if ($data['service']['id'] == 9 || $data['service']['id'] == 10 || $data['service']['id'] == 11) {
            return view('front.ask', get_defined_vars());
        }elseif ($data['service']['id'] == 8) {
            if($lawyer_id > 0 || $blog_id > 0) {
                return view('front.ask_price_request', get_defined_vars());
            }
            return view('front.all_fixed_services', get_defined_vars());
        }elseif ($data['service']['id'] == 6) {
            return view('front.ask_price_request', get_defined_vars());
        }
        // elseif ($data['service']['id'] == 8) {
        //     return view('front.hire_a_lawyer', get_defined_vars());
        // }
        $this->home();
        // if ($data['service']['id'] == 6) {
        //     return view('front.ask_price', get_defined_vars());
        // }elseif ($data['service']['id'] == 8) {
        //     return view('front.hire_a_lawyer', get_defined_vars());
        // }elseif ($data['service']['id'] == 9) {
        //     return view('front.ask_chat', get_defined_vars());
        // }elseif ($data['service']['id'] == 10) {
        //     return view('front.ask_call', get_defined_vars());
        // }elseif ($data['service']['id'] == 11) {
        //     return view('front.ask_lawyer', get_defined_vars());
        // }
    }

    public function askPrice($id)
    {
        $data = $this->reportPage(['settings', 'blog' => function($query) use($id) {
            return $query->with('section')->find($id);
        }, ]);
        return view('front.ask_price_details', compact('data'));
    }

    public function lawyersJosn(Request $request)
    {
        return $this->lawyerRepository->search($request);
    }

}
