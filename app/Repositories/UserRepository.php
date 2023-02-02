<?php
 namespace App\Repositories;
 use Illuminate\Database\Eloquent\Model;
 use DB;
 class  UserRepository implements RepositoryInterface
{
	// model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;

    }

    // Get all instances of model
    public function all($id='')
    {
        if(!empty($id)){
        return $this->model->all()->sortByDesc($id);
        }else{
        return $this->model->all();    
        }
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
  /*  public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    } */

    public function update(array $data,$id)
    {
        $this->model::where('id', $id)->update($data);
    }

    public function updateWithId(array $data,$id,$idname)
    {
        $this->model::where($idname, $id)->update($data);
    }


     public function find($id)
    {
        return $this->model::where('id', $id)->first();
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function deleteRecord($id,$idname)
    {
        return $this->model->where($idname,$id)->delete();
    }


    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function where(array $data){
        return $this->model->where($data)->orderBy('id', 'desc')->get();
    }

    public function get_first_record($id,$idname){
        return $this->model->where($idname,$id)->orderBy($idname, 'desc')->first();
    }
    
    public function get_first_records(array $data){
        return $this->model->where($data)->first();
    }


    public function get_record($id,$idname){
        return $this->model->where($idname,$id)->get();
    }

    public function insert($data){
        return $this->model->insert($data);
    }
     public function pagination(){
        return $this->model->orderBy('id', 'desc')->paginate(20);
    }
}
?>