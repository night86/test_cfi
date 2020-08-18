<?php namespace App\Controllers;

use App\Models\UsersModel as Users;
use App\Models\WordsModel as Words;
use CodeIgniter\API\ResponseTrait as Response;

class Home extends BaseController
{
	use Response;

    public function index()
	{
	    return view('index');
	}

	public function ajax(){

	    $ip = $this->request->getPost('ip');
	    $words = strtolower($this->request->getPost('words'));

        $usersModel = new Users();
        $wordsModel = new Words();

        $user = $usersModel->where('ip', $ip)->first();
        $newstr = preg_replace('/[^a-zA-Z0-9\']/', '_', $words);
        $splitWords = explode('_', $newstr);
        $wordList = [];
        $htmlResponse = [];
        $i = 1;
        $j = 3;

        if(empty($user)) {

            $usersModel->insert(['ip' => $ip]);
            $user = $usersModel->where('ip', $ip)->first();
        }

        foreach ($splitWords as $w){

            if($w == "" || (strlen($w) < 3)){
                continue;
            }
            else {
                $wordList[] = $w;
            }
        }

        foreach($wordList as $word){

            $findWord = $wordsModel->asArray()->where('user_id', $user['id'])->where('word', $word)->first();
            $count = substr_count($words, $word);

            if(empty($findWord)){

                $newWord = new Words();
                $newWord->save(['user_id' => $user['id'], 'word' => $word, 'count' => $count]);
            }
            else {
                $wordsModel->save(['id' => $findWord['id'], 'count' => $count]);
            }
        }
        $result = $wordsModel->where('user_id', $user['id'])
            ->whereIn('word', $wordList)
            ->orderBy('count', 'desc')
            ->orderBy('word', 'asc')
            ->findAll();

        foreach ($result as $r){

            $htmlResponse[] = '<tr>
                                    <th scope="row">'.$i.'</th>
                                    <td>'.$r["word"].'</td>
                                    <td>'.$r["count"].'</td>
                                    <td>'.(($j >= 1) ? str_repeat("*", $j) : "-").'</td>
                                </tr>';
            $i++;
            $j--;
        }
        return $this->respond($htmlResponse, 200);
    }
}
