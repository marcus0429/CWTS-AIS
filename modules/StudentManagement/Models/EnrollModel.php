<?php
namespace Modules\StudentManagement\Models;

use CodeIgniter\Model;

class EnrollModel extends \CodeIgniter\Model
{
     protected $table = 'enrollment';

     protected $allowedFields = ['id','student_id','stud_num','subject_id','schyear_id','status','created_at','deleted_at','updated_at'];

     public function getSpecificStudent($stud_num){

       $this->where('stud_num', $stud_num);

       return $this->findAll();
     }

     public function getStudents(){
       $this->select('enrollment.id, student.firstname, student.lastname, student.middlename, student.stud_num, course.course, subjects.subject');
       $this->join('student', 'student.id = enrollment.student_id');
       $this->join('subjects  ', 'subjects.id = enrollment.subject_id');
       $this->join('course', 'student.course_id = course.id');
       $this->where('enrollment.status', 'i');
       return $this->findAll();
     }
     public function getStudentsForm(){
       $this->select('enrollment.id as id, student.stud_num, student.firstname, student.middlename, student.lastname');
       $this->join('student', 'student.id = enrollment.student_id');
       $this->join('subjects  ', 'subjects.id = enrollment.subject_id');
       $this->join('course', 'student.course_id = course.id');
       $this->where('enrollment.status', 'i');
       return $this->findAll();
     }
     public function getSpecificStudentById($id){
       $this->select('subjects.subject, subjects.required_hrs, enrollment.status, enrollment.id as enrollment_id');
       $this->join('student', 'student.id = enrollment.student_id');
       $this->join('subjects  ', 'subjects.id = enrollment.subject_id');
       $this->join('course', 'student.course_id = course.id');
       $this->where('student.id', $id);
       return $this->findAll();
     }

     public function addStudentEnroll($data){
      $data['created_at'] = (new \DateTime())->format('Y-m-d H:i:s');
      $data['status'] = 'i';
   	  return $this->save($data);
     }

     public function selectSpecificEnroll($data){
       $this->select('enrollment.id as id, subjects.required_hrs, student.id as student_id');
       $this->join('student', 'student.id = enrollment.student_id');
       $this->join('subjects', 'subjects.id = enrollment.subject_id');
       $this->where('enrollment.status', 'i');
       $this->where('stud_num', $data);
       return $this->findAll();
     }

     public function selectStudent($id){
       $this->where('student_id', $id);
       $this->where('status', 'i');
       return $this->first();
     }

     public function markComplete($id){
       $data = ['status' => 'c'];
       return $this->update($id, $data);
    }

    public function deleteStudent($id)
  	{
		return $this->delete($id);
	  }
}
