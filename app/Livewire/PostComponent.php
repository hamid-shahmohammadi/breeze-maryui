<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\PostForm;

class PostComponent extends Component
{
    use WithPagination;
    public PostForm $form;
    public bool $postModal = false;
    public bool $editModal = false;

    public array $sortBy = ['column' => 'title', 'direction' => 'asc'];


    public function save()
    {
        $this->validate();

        Post::create(
            $this->form->all()
        );

        $this->postModal = false;
    }
    public function editPost ($post){

        $this->form->id=$post['id'];
        $this->form->title=$post['title'];
        $this->form->slug=$post['slug'];
        $this->form->content=$post['content'];
        $this->editModal=true;
    }
    public function update (){
        Post::where('id',$this->form->id)->update([
            'title'=>$this->form->title,
            'slug'=>$this->form->slug,
            'content'=>$this->form->content,
        ]);
        $this->editModal=false;
    }
    public function deletePost ($post){
        Post::where('id',$post['id'])->delete();
    }

    public function render()
    {

        $posts = Post::orderBy(...array_values($this->sortBy))->paginate();

        $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'title', 'label' => 'Title'],
        ['key' => 'slug', 'label' => 'Slug'] # <---- nested attributes
    ];
        return view('livewire.post-component',compact('posts','headers'));
    }
}
