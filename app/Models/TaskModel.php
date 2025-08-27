<?php

namespace App\Models;

use App\Helpers\Date;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table            = 'tasks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'completed'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'id' => 'integer',
        'completed' => 'boolean',
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => 'required|min_length[3]|max_length[255]',
    ];
    protected $validationMessages   = [
        'title' => [
            'required' => 'El titulo es obligatorio',
            'min_lenth' => 'El titulo debe tener minimo 3 caracteres',
            'max_length' => 'El titulo debe tener maximo 255 caracteres',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['dateFormater'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // protected function formatAfterInsert($data)
    // {
    //     if (isset($data['id'])) {
    //         $task = $this->find($data['id']);
    //         $data['result'] = $task;
    //         $data['data'] = $task;
    //     }

    //     return $data;
    // }
    // protected function formatAfterUpdate($data)
    // {
    //     if (isset($data['id'])) {
    //         $task = $this->find($data['id']);
    //         $data['result'] = $task;
    //     }

    //     return $data;
    // }
    // Callback: formatea la fecha
    protected function dateFormater($data)
    {
        if (empty($data['data'])) {
            return $data;
        }

        switch ($data['method']) {
            case 'find':
                if (is_array($data["id"])) {
                    $data["data"] = $this->formatDate($data["data"]);
                } else {
                    $dateFormat = new Date($data['data']['created_at']);
                    $data['data']['created_at'] = $dateFormat::formatEuropean();
                }
                break;
            case 'findAll':
                $data["data"] = $this->formatDate($data["data"]);
                break;
        }

        return $data;
    }

    private function formatDate(array $data): array
    {
        foreach ($data as $key => $task) {
            $dateFormat = new Date($task['created_at']);
            $data[$key]['created_at'] = $dateFormat::formatEuropean();
        }

        return $data;
    }
}
