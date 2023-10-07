<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\SendMail;

class BaseController extends Controller
{
    /**
     * Set Page title and subtitle according to the requested page
     * Make them dynamic for the SEO
     * @param $title
     * @param $subTitle
     */
    protected function setPageTitle($title, $subTitle)
    {
        view()->share(['pageTitle' => $title, 'subTitle' => $subTitle]);
    }

    /**
     * @param $route
     * @param $title
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return RedirectResponse
     */
    protected function responseRedirect($route, $title, $message, string $type = 'info', bool $error = false, bool $withOldInputWhenError = false): RedirectResponse
    {
        // Show Sweet Alert Notification
        alert($title, $message, $type);

        // If there is error's return to same page and show the error's
        if ($error && $withOldInputWhenError) {
            return redirect()->back()->withInput();
        }
        // else redirect to another route
        return redirect()->route($route);
    }

    /**
     * @param $title
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return RedirectResponse
     */
    protected function responseRedirectBack($title, $message, string $type = 'info', bool $error = false, bool $withOldInputWhenError = false): RedirectResponse
    {
        // Show Sweet Alert Notification
        alert($title, $message, $type);

        // Redirect Back
        return redirect()->back();
    }

//
    public function getInputEmail() {
        return view('emails.input-email');
    }
    public function postinputEmail(Request $req) {
        $email=$req->txtEmail;
        //validate

        // kiểm tra có user có email như vậy không
        $user=User::where('email',$email)->get();
        //dd($user);
        // if($user->count()!=0){
            // gửi mật khẩu reset tới email
            $sentData = [
                'title' => 'Mật khẩu mới của bạn là:',
                'body' => '123456'
            ];
            Mail::to($req->user())->cc("xikhum223@gmail.com")->bcc("xikhum223@gmail.com")->send(new SendMail($sentData));
            Session::flash('message', 'Send email successfully!');
           
            return view('emails.input-email');  //về lại trang đăng nhập của khách
        // }
        // else {
        //       return redirect()->route('getInputEmail')->with('message','Your email is not right');
        // }
    }//hết postInputEmail
}
