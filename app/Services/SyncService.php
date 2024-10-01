<?php

namespace App\Services;

use App\Models\User;
use App\Models\Company;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class SyncService {

    /*
    protected $_master_company = [
                "BUOP Tuban" => '7000',
                "PT Semen Gresik" => '5000',
                "PT Semen Indonesia" => '2000',
                "PT Semen Padang" => '3000',
                "PT Semen Tonasa" => '4000',
            ];

    public function syncUserSinta($_api_session, $company, $nik = null){
        ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
        
        $_data_sinta = [];
        try{
            $data['query'] = "{
                \"query\":{
                    \"source-table\":358,
                    \"filter\":[
                        \"and\",
                        [\"=\",[\"field\",3500,null],\"{$company}\"]
                    ]
                },
                \"type\":\"query\",
                \"database\":2,
                \"middleware\":{
                    \"js-int-to-string?\":true,
                    \"add-default-userland-constraints?\":true
                }
            }";

            $url =  config('app.api_sinta_dataset');
            $client = new \GuzzleHttp\Client();
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded','X-Metabase-Session' => $_api_session],
                'verify' => false,
                'form_params' => $data
            ]); 

             return $_data_sinta = json_decode($response->getBody()->getContents(),true);
        }
        catch(\GuzzleHttp\Exception\GuzzleException $ex){
            return ['success' => false, 'message' => $ex->getMessage()];
        }

        try{
            $_comp = m_company::where('company_name', $company)->first();
            
            if($nik !== null){
                $_data_sinta_by_nik = [];
                $_list_nik = array_column($_data_sinta, 'No Pegawai');
                $key = array_search($nik, $_list_nik);

                if($key || $key == 0) $_data_sinta_by_nik = $_data_sinta[$key];

                $_data_sinta = [];

                if(!empty($_data_sinta_by_nik))
                    $_data_sinta[0] = $_data_sinta_by_nik;
            }

            if(empty($_data_sinta)){
                return ['success' => false, 'message' => 'NIK Not Found!'];
            }

            $_count = 0;

            foreach($_data_sinta as $row){
                $_nama_uk = !(is_null($row['Unit']) || $row['Unit']=='') ? $row['Unit'] : $row['Nama Jabatan'];
                $_unit = UnitKerja::where('nama_uk', $_nama_uk)->first();
                if(is_null($_unit))
                    $_unit = UnitKerja::updateOrCreate(['id_company' => $_comp->id, 'nama_uk' => $_nama_uk],['kode_uk'=>$_comp->id_company.'-'.rand(1,100) ,'id_company' => $_comp->id, 'nama_uk' => $_nama_uk]);
                
                $_username = !(is_null($row['UserName']) || $row['UserName']=='') ? $row['UserName'] : strtolower(preg_replace("/[^A-Za-z0-9 ]/", '.', $row['Nama Lengkap'])).'@sig.id';
                $_user = User::where('username',$_username)->first();
                $_params = [];
                $_params['nik'] = $row['No Pegawai'];
                $_params['username'] = $_username;
                $_params['email'] = !(is_null($row['Email']) || $row['Email']=='') ? $row['Email'] : strtolower(preg_replace("/[^A-Za-z0-9 ]/", '.', $row['Nama Lengkap'])).'@sig.id';
                $_params['fullname'] = $row['Nama Lengkap'];
                $_params['nama_uk'] = $_nama_uk;
                $_params['jabatan'] = $row['Nama Jabatan'];
                $_params['id_company'] = $_comp->id;
                if(!is_null($_user)){
                    $_user = User::where('username',$_params['username'])->update($_params);
                }
                else{
                    $_params['password'] = app('hash')->make('mahatahusegalanya');
                    $_user = User::create($_params);
                }
                $_count++;
            }
            return ['success' => true, 'user' => $_user, 'count'=>$_count];
        }
        catch(\Exception $ex){
            return ['success' => false, 'message' => $ex->getMessage()];
        }
    }
    */

    public function syncData($token){
        ini_set('max_execution_time', '3600'); //3600 seconds = 1 hour
        $_data = [];

        try{
            $url =  'http://localhost:8080/getData';
            $client = new \GuzzleHttp\Client();
            $response = $client->get($url, [
                'headers' => ['Content-Type' => 'application/json',
                              'Authorization' => 'Bearer '.$token],
                'verify' => false,
            ]);

            $_data = json_decode($response->getBody()->getContents(),true);
            // return json_decode($response->getBody()->getContents(),true);
            // $_data = $response->json();
        }catch(\GuzzleHttp\Exception\GuzzleException $ex){
            return ['success' => false, 'message' => $ex->getMessage()];
        }

        try{
            $_count = 0;
            
            $_company_list = Company::all()
                            ->keyBy('company_code')
                            ->toArray();
            
            foreach($_data['data'] as $_row){
                if(!isset($_company_list[$_row['Company Company Code']]))
                    Company::updateOrCreate([
                        'company_code' => $_row['Company Company Code'],
                        'company_name' => $_row['Company Company Name']
                    ]);
                if(User::where('employee_id', $_row['Employee ID'])->first())
                    continue;
                $nama = $_row['First Name'] . " " . $_row['Last Name'];
                User::updateOrCreate([
                    'employee_id' => $_row['Employee ID'],
                    // 'username'=> !(is_null($row['UserName']) || $row['UserName']=='') ? $row['UserName'] : strtolower(preg_replace("/[^A-Za-z0-9 ]/", '.', $row['Nama Lengkap'])).'@sig.id',
                    'username'=> !(is_null($_row['Business Email Information Email Address']) || $_row['Business Email Information Email Address']=='') ? $_row['Business Email Information Email Address'] : strtolower(preg_replace("/[^A-Za-z0-9 ]/", '.', $nama)).'@sig.id',
                    'password'=> hash::make('test'),
                    'name'=> $_row['First Name'] . " " . $_row['Last Name'],
                    // 'email'=> !(is_null($row['Email']) || $row['Email']=='') ? $row['Email'] : strtolower(preg_replace("/[^A-Za-z0-9 ]/", '.', $row['Nama Lengkap'])).'@sig.id',
                    'email'=> !(is_null($_row['Business Email Information Email Address']) || $_row['Business Email Information Email Address']=='') ? $_row['Business Email Information Email Address'] : strtolower(preg_replace("/[^A-Za-z0-9 ]/", '.', $nama)).'@sig.id',
                    'position_title'=> $_row['Position Title'],
                    'company_code' => $_row['Company Company Code'],
                    'company_name'=> $_row['Company Company Name'],
                    'directorate_name'=> $_row['Directorate Directorate Name'],
                    'group_function_name'=> $_row['Group Function Group Function Name'],
                    'department_name'=> $_row['Department Department Name'],
                    'unit_name'=> $_row['Unit Name'],
                    'section_name'=> $_row['Section Name'],
                    'sub_section_of'=> $_row['Sub-Section Of'],
                    'date_of_birth'=> $_row['Date of Birth'],
                    'gender'=> $_row['gender'],
                    'job_level'=> $_row['Job Level'],
                    'contract_type'=> $_row['Contract Type'],
                    'home_company'=> $_row['Employment Details Home Company'],
                    'manager_id'=> $_row['Manager User Sys ID'],
                    'role' => 'User',
                ]);
                $_count++;
            }
        }catch(\Exception $ex){
            return ['success' => false, 'message' => $ex->getMessage()];
        }
        return ['success' => true, 'message' => "Sinkornisasi database berhasil", 'count'=>$_count];
    }

    public function getSession(){
        try{
            $data = array(
                'user' => 'adminsync',
                'password' => 'passsync'
            );

            $url =  'http://localhost:8080/getSession';
            $client = new \GuzzleHttp\Client();
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json'],
                'verify' => false,
                'body'    => json_encode($data)
            ]); 

            $result = json_decode($response->getBody()->getContents(),true);
            return ['success' => true, 'token' => $result['token']];
        }
        catch(\GuzzleHttp\Exception\GuzzleException $ex){
            return ['success' => false, 'message' => $ex->getMessage()];
        }
    }
}