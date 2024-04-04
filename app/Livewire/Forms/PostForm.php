<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public $id;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $slug = '';

    #[Validate('required|min:5')]
    public $content = '';
}
