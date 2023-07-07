<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $envValues = [];
         if($request->has('app_name')){
            $envValues['APP_NAME'] = $request->app_name;
        }
         if($request->has('app_env')){
            $envValues['APP_ENV']=$request->app_env;
        }
         if($request->has('app_debug')){
            $envValues['APP_DEBUG']=$request->app_debug;
        }
         if($request->has('mail_driver')){
            $envValues['MAIL_MAILER']=$request->mail_driver;
        }
         if($request->has('mail_host')){
            $envValues['MAIL_HOST']=$request->mail_host;
        }
         if($request->has('mail_port')){
            $envValues['MAIL_PORT']=$request->mail_port;
        }
         if($request->has('mail_encryption')){
            $envValues['MAIL_ENCRYPTION']=$request->mail_encryption;
        }
         if($request->has('mail_username')){
            $envValues['MAIL_USERNAME']=$request->mail_username;
        }
         if($request->has('mail_password')){
            $envValues['MAIL_PASSWORD']=$request->mail_password;
        }
         if($request->has('mail_from_address')){
            $envValues['MAIL_FROM_ADDRESS']=$request->mail_from_address;
        }
         if($request->has('mail_from_name')){
            $envValues['MAIL_FROM_NAME']=$request->mail_from_name;
        }
        $this->setEnvironmentValue($envValues);
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Cache::flush();        
        Artisan::call('config:cache');
        return redirect()->back()->withStatus('Settings Updated Successfully');
    }

    private function setEnv($key, $value)
{
    file_put_contents(app()->environmentFilePath(), str_replace(
        $key . '=' . env($value),
        $key . '=' . $value,
        file_get_contents(app()->environmentFilePath())
    ));
}
public function setEnvironmentValue(array $values)
    {
       
        $envFile = app()->environmentFilePath();
        $str = "\n";
        $str .= file_get_contents($envFile);
        $str .= "\n"; // In case the searched variable is in the last line without \n
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                if ($envValue == trim($envValue) && strpos($envValue, ' ') !== false) {
                    $envValue = '"'.$envValue.'"';
                }

                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if ((! $keyPosition && $keyPosition != 0) || ! $endOfLinePosition || ! $oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    if($envKey=="DB_PASSWORD"){
                        $str = str_replace($oldLine, "{$envKey}=\"{$envValue}\"", $str);
                    }else{
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }
                    
                }
            }
        }

        $str = substr($str, 1, -1);
        if (! file_put_contents($envFile, $str)) {
            return false;
        }

        return true;
    }
}
