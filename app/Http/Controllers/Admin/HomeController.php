<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\Admin\CityRepository;
use App\Http\Repositories\Eloquent\Admin\CountryRepository;
use App\Http\Repositories\Eloquent\Admin\HomeRepository;
use App\Http\Repositories\Eloquent\Admin\LanguageRepository;
use App\Http\Repositories\Eloquent\Admin\LawyerRepository;
use App\Http\Repositories\Eloquent\Admin\LegalFieldRepository;
use App\Http\Repositories\Eloquent\Admin\SectionRepository;
use App\Http\Repositories\Eloquent\Admin\ServiceRepository;
use App\Http\Repositories\Eloquent\Admin\SubjectRepository;
use App\Http\Repositories\Eloquent\Admin\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $home;
    public $countryRepository;
    public $cityRepository;
    public $languageRepository;
    public $sectionRepository;
    public $serviceRepository;
    public $lawyerRepository;
    public $userRepository;
    public $subjectRepository;
    public $legalFieldRepository;

    public function __construct(
        HomeRepository $home, CountryRepository $countryRepository, CityRepository $cityRepository, LanguageRepository $languageRepository,
        ServiceRepository $serviceRepository, SectionRepository $sectionRepository, LawyerRepository $lawyerRepository, 
        UserRepository $userRepository, SubjectRepository $subjectRepository, LegalFieldRepository $legalFieldRepository
    ){
        $this->home = $home;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
        $this->languageRepository = $languageRepository;
        $this->sectionRepository = $sectionRepository;
        $this->serviceRepository = $serviceRepository;
        $this->lawyerRepository = $lawyerRepository;
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->legalFieldRepository = $legalFieldRepository;
    }

    public function home()
    {
        return $this->home->home();
    }

    public function countries(Request $request)
    {
        return $this->countryRepository->search($request);
    }

    public function country_cities(Request $request)
    {
        return $this->cityRepository->country_cities($request);
    }

    public function cities(Request $request)
    {
        return $this->cityRepository->search($request);
    }

    public function languages(Request $request)
    {
        return $this->languageRepository->search($request);
    }

    public function sections(Request $request)
    {
        return $this->sectionRepository->search($request);
    }

    public function services(Request $request)
    {
        return $this->serviceRepository->search($request);
    }

    public function lawyers(Request $request)
    {
        return $this->lawyerRepository->search($request);
    }

    public function users(Request $request)
    {
        return $this->userRepository->search($request);
    }

    public function subjects(Request $request)
    {
        return $this->subjectRepository->search($request);
    }

    public function legal_fields(Request $request)
    {
        return $this->legalFieldRepository->search($request);
    }

}
