<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use GuzzleHttp\Client;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

            $categories = [1=>9,2=>10,3=>11,4=>12,5=>13,6=>14,7=>15,8=>16,9=>17,10=>18,11=>19,12=>20,13=>21,14=>22,15=>23,16=>24,17=>25,18=>26,19=>27,20=>28,21=>29,22=>30,23=>31,24=>32];
            foreach ($categories as $key => $value) {
             // Send a GET request to the API endpoint
            $response = $client->request('GET', 'https://opentdb.com/api.php?amount=100&category='.$value, [
                'curl' => [
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                ],
            ]);


            // Retrieve the response content
            $data = $response->getBody()->getContents();          
            $data = json_decode($data, true);

                foreach ($data['results'] as &$item) {
                    $difficulty = 1;
                    if($item['difficulty'] == 'easy'){
                        $difficulty = 1;
                    }
                    if($item['difficulty'] == 'medium'){
                        $difficulty = 2;
                    }
                    if($item['difficulty'] == 'hard'){
                        $difficulty = 3;
                    }
                    if($item['type'] == 'boolean'){
                        $type = 1;
                    }else{
                        $type = 0;
                    }


                    $choices = array_merge([$item['correct_answer']], $item['incorrect_answers']);
                    shuffle($choices);
                    $answer = array_search($item['correct_answer'], $choices);
                    $array = [1, 2, 3];//return 1st  user ids
                    $question = Question::create([
                    'question'=>$item['question'],
                    'category_id'=>$key,
                    'active'=>1,
                    'type'=>$type,
                    'level'=>$difficulty,
                    'choices'=>json_encode($choices),
                    'answer'=>$answer,
                    'summary'=>'',
                    'created_by'=>$array[array_rand($array)],
                    ]);
                }
            }

        
    }
}

