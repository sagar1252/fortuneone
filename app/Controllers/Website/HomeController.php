<?php

namespace App\Controllers\Website;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index(): string
    {
        $data = [
            'meta_title' => 'Home | Fortune One Developers',
            'meta_description' => 'Discover Fortune One, building premium plotted developments, luxury farmlands, and commercial projects across key growth corridors.'
        ];
        return view('Website/Pages/home', $data);
    }
     public function about(): string
    {
        $data = [
            'meta_title' => 'About Us | Fortune One',
            'meta_description' => 'Learn about Fortune One, a Bengaluru-based real estate development company built on the principles of trust, transparency, and thoughtful design.'
        ];
        return view('Website/Pages/about', $data);
    }
    public function services(): string
    {
        return view('Website/Pages/services');
    }
    public function projects(): string
    {
        return view('Website/Pages/projects');
    }
    public function career(): string
    {
        $data = [
            'meta_title' => 'Careers | Fortune One',
            'meta_description' => 'Join the Fortune One team and shape the future of enterprise and luxury real estate developments.'
        ];
        return view('Website/Pages/career', $data);
    }
    public function contact(): string
    {
        $data = [
            'meta_title' => 'Contact Us | Fortune One',
            'meta_description' => 'Get in touch with Fortune One for property pricing, investment opportunities, or to schedule a site visit.'
        ];
        return view('Website/Pages/contact', $data);
    }
    public function blog(): string
    {
        $data = [
            'meta_title' => 'Blog | Fortune One Insights',
            'meta_description' => 'Read the latest news, insights, and updates from Fortune One on real estate trends and company developments.'
        ];
        return view('Website/Pages/blog', $data);
    }
      public function portfolio(): string
    {
        $data = [
            'meta_title' => 'Our Portfolio | Fortune One Projects',
            'meta_description' => 'Explore Fortune One\'s landmark achievements including EshaVana, Vistaa, Skylark, and Pyramid premium developments.'
        ];
        return view('Website/Pages/portfolio', $data);
    }
      public function nrisupport(): string
    {
        $data = [
            'meta_title' => 'NRI Support | Fortune One',
            'meta_description' => 'Dedicated support and guidance for Non-Resident Indians investing in Fortune One premium real estate properties.'
        ];
        return view('Website/Pages/nrisupport', $data);
    } 
    public function journey(): string
    {
        return view('Website/Layouts/header') . view('Website/Pages/Journey') . view('Website/Layouts/footer');
    }
     public function process(): string
    {
        return view('Website/Partials/process');
    }
    

    public function blogPost1(): string
    {
        $data = [
            'meta_title' => 'The Evolution of Smart Homes | Fortune One Blog',
            'meta_description' => 'Explore how technology and automation are redefining luxury living and modern construction trends.'
        ];
        return view('Website/Blog/smart-homes', $data);
    }

    public function blogPost2(): string
    {
        $data = [
            'meta_title' => 'Sustainable Building Materials | Fortune One Blog',
            'meta_description' => 'Discover the rise of eco-friendly construction materials and the future of green architecture.'
        ];
        return view('Website/Blog/sustainable-building', $data);
    }

    public function blogPost3(): string
    {
        $data = [
            'meta_title' => 'Virtual Reality in Architecture | Fortune One Blog',
            'meta_description' => 'Learn how virtual reality and 3D modeling are reshaping architectural design and real estate planning.'
        ];
        return view('Website/Blog/virtual-reality', $data);
    }

}

