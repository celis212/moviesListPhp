
class Posts{
    public function __construct(){
        $this->postModel = $this->model('post');
    }

    //app.com/index.php?url=posts
    public function index(){

    }
    //app.com/index.php?url=posts/add
    public function ass(){
        
    }
    //app.com/index.php?url=posts/edit/1
    public function edit($id){
        $post = $this->postModel->fetchPost($id);
        $this->view('edit',['post' => $post]);
        //echo $id;
    }
}

<h1><?php echo $data['title']; ?></h1>
