<?php namespace App\Models;

use CodeIgniter\Model;

class WordsModel extends Model
{
    protected $table      = 'words';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['user_id', 'word', 'count'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}
