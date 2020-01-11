<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use App\Form\EmailForm;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ForumsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->adminSideBarHasSub('forums');
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->header();
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(array("controller" => "Dashboard",
                       "action" => "index"));
            }
            else {
                $this->Flash->logout('Your username or password is incorrect.');
            }
        }
    }

    public function logout()
    {
        $this->Flash->logout('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function forumCategories() {

        $this->adminHeaderSidebar('forumCategories');
        $this->title('Admin | Forum Categories');
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');

        $forumCategories = $this->paginate($this->ForumCategories->find('all')->contain('ForumCategoryDetails')->where(['ForumCategories.forum_category_active' => 1]));
        $this->set(compact('forumCategories'));
        $this->log($forumCategories->first(),'debug');
    }

    public function forumAddCategory()
    {       
        $this->header();
        $this->adminHeaderSidebar('forumCategories');
        $this->title('Admin | Add Category');

        $this->loadModel('UserActivities');
        $this->loadModel('ForumActivities');
        $this->loadModel('ForumCategoryActivities');
        $this->loadModel('ForumCategories');
        $this->loadModel('ForumCategoryDetails');

        $currentUser = $this->Auth->user('id');

        $userActivity = $this->UserActivities->newEntity();
        $forumActivity = $this->ForumActivities->newEntity();
        $forumCategoryActivity = $this->ForumCategoryActivities->newEntity();
        $forumCategory = $this->ForumCategories->newEntity();
        $forumCategoryDetail = $this->ForumCategoryDetails->newEntity();

        $this->set('forumCategory',$forumCategory);

        if ($this->request->is('post')) {
        
            // Get category
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['forum_category_icon']['name'])) {
                    $file = $this->request->data['forum_category_icon']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);
                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = '_default.jpg';
                }

                $userActivity->user_activity_activity_type_id = 2;
                $userActivity->user_activity_user_id = $currentUser;

                if ($activityID = $this->UserActivities->save($userActivity)) {

                    $forumActivity->forum_activity_type_id = 1;
                    $forumActivity->forum_activity_user_id = $currentUser;
                    $forumActivity->forum_activity_activity_id = $activityID->user_activity_id;

                    if ($forumActivityID = $this->ForumActivities->save($forumActivity)) {

                        $forum_category_name = $this->request->data['forum_category_name'];
                        $forum_category_icon = $this->request->data['forum_category_icon'];

                        $forumCategory->forum_category_name = $forum_category_name;
                        $forumCategory->forum_category_icon = $imageFileName;
                        $forumCategory->forum_category_created_by_user_id = $currentUser;

                        if ($forumCategoryID = $this->ForumCategories->save($forumCategory)) {

                            $forumCategoryActivity->forum_category_activity_forum_activity_id = $forumActivityID->forum_activity_id;
                            $forumCategoryActivity->forum_category_activity_forum_category_id = $forumCategoryID->forum_category_id;

                            if ($forumCategoryActivityID = $this->ForumCategoryActivities->save($forumCategoryActivity)) {

                                $forumCategoryDetail->forum_category_detail_category_id = $forumCategoryID->forum_category_id;

                                if ($forumCategoryDetailID = $this->ForumCategoryDetails->save($forumCategoryDetail)) {
                                    $this->Flash->success('Category Added!', [
                                        'params' => [
                                        'saves' => 'Category Updated!'
                                        ]
                                    ]);
                                    return $this->redirect(['action' => 'forumCategories']);
                                }
                            }
                        }

                    }
                }
            }

        }
    }

    public function forumEditCategory($forum_category_id)
    {       
        $this->header();
        $this->adminHeaderSidebar('forumCategories');
        $this->title('Admin | Edit Category');

        $this->loadModel('ForumCategories');

        $forumCategory = $this->ForumCategories->find('all')->contain(["Users"])->where(['ForumCategories.forum_category_id' => $forum_category_id])->first();
        $this->set('forumCategory',$forumCategory);

        if ($this->request->is(['post', 'put'])) {
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['forum_category_icon']['name'])) {
                    $file = $this->request->data['forum_category_icon']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = $forumCategory->forum_category_icon;
                }

                $forumCategoriesTable = TableRegistry::get('ForumCategories');
                $forumCategoriesTable = TableRegistry::getTableLocator()->get('ForumCategories');
                $forumCategory = $forumCategoriesTable->get($forum_category_id);

                $forumCategory->forum_category_name = $this->request->data('forum_category_name');
                $forumCategory->forum_category_icon = $imageFileName;
            
            }

                if ($forumCategoriesTable->save($forumCategory)) {
                    $this->Flash->success('Forum Updated!', [
                    'params' => [
                        'saves' => 'Forum Updated!'
                        ]
                    ]);
                    return $this->redirect(['action' => 'forumCategories']);
                }
            else {
                $this->log($admin->errors(),'debug');
                    $this->Flash->error($admin->errors(), [
                        'params' => [
                            'saves' => $admin->errors()
                        ]
                    ]);
            }
            
        }
    }

    public function forumDeleteCategory()
    {   
        $this->layout = false;
        $this->autoRender = false;

        $this->loadModel('ForumCategories');

        if ($this->request->is(['post', 'put'])) {

            $forum_category_id = $this->request->data('forum_category_id');
            $this->log($forum_category_id,'debug');
            
            $forumCategoriesTable = TableRegistry::get('ForumCategories');
            $forumCategoriesTable = TableRegistry::getTableLocator()->get('ForumCategories');
            $forumCategory = $forumCategoriesTable->get($forum_category_id);

            $forumCategory->forum_category_active = 0;

            if ($forumCategoriesTable->save($forumCategory)) {
                $this->Flash->success('Category Deleted!', [
                    'params' => [
                        'saves' => 'Category Deleted!!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->success('User Removed!', [
                    'params' => [
                        'saves' => 'User Removed!!'
                    ]
                ]);
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    // User: Employee

    public function employeesAll() 
    {
        $this->header();
        $this->adminHeaderSidebar('users-employees');
        $this->title('Admin | User Employees');

        $this->loadModel("Users");
        $this->loadModel("User_Employees");

        $employees = $this->User_Employees->find('all')->contain(["Users.UserTypes"])->where(['Users.active' => 1]);
        $employees = $this->paginate($employees);

        $this->set(compact('employees'));
    }



    public function employeeAdd()
    {       
        $this->header();
        $this->adminHeaderSidebar('users-employees');
        $this->title('Admin | Add User');

        $this->loadModel('Users');
        $this->loadModel('User_Employees');
        $this->loadModel('User_Profiles');

        $employee = $this->User_Employees->Users->newEntity();
        $user = $this->Users->newEntity();
        $profile = $this->User_Profiles->newEntity();
        $this->set('employee',$employee);

        $this->loadModel('EmployeePositionNames');
        $employee_positions =  $this->EmployeePositionNames->find('list', ['keyField' => 'employee_position_id', 'valueField' => 'employee_position_name'])->where(['EmployeePositionNames.active' => 1])->order([
        'EmployeePositionNames.employee_position_priority' => 'ASC'
        ]);
        $this->set('employee_positions', $employee_positions);

        if ($this->request->is('post')) {

            $user_employee_lastname = $this->request->data['user_employee_lastname'];
            $user_employee_firstname = $this->request->data['user_employee_firstname'];
            $user_employee_middlename = $this->request->data['user_employee_middlename'];
            $fullname = $user_employee_lastname . ', ' . $user_employee_firstname . ' ' . substr($user_employee_middlename,0,1) . '.';

            $email = $this->request->data['email'];
            $username = $this->request->data['username'];
        
            $factory = new \RandomLib\Factory;
            $randomLength = rand(8,12);
            $alphanumeric = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUV0123456789';
            $generator = $factory->getMediumStrengthGenerator();
            $password = $generator->generateString($randomLength, $alphanumeric);
            $hasher = new DefaultPasswordHasher();
        
            // Get admin photo
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_employee_photo']['name'])) {
                    $file = $this->request->data['user_employee_photo']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);
                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = '_default.jpg';
                }

                $user->email = $email;
                $user->password = $hasher->hash($password);
                $user->username = $username;
                $user->active = 1;
                $user->user_type_id = 2;

                $employee->user_employee_lastname = $user_employee_lastname;
                $employee->user_employee_firstname = $user_employee_firstname;
                $employee->user_employee_middlename = $user_employee_middlename;
                $employee->user_employee_photo = $imageFileName;
                $employee->user_employee_position_id = $this->request->data(['user_employee_position_id']);

                $profile->user_profile_photo = $imageFileName;
                $profile->user_cover_photo = 'default_user_cover.png';
                $profile->user_profile_background = 'white';
                $profile->user_profile_bio = '';
            

                if (!empty($this->request->data['user_employee_photo']['name'])) {
                    $employee->user_employee_photo = $imageFileName;
                }
            }

            if ($addedUser = $this->Users->save($user)) {
                $employee->user_id = $addedUser->id;
                if ($this->User_Employees->save($employee)) {
                    $profile->user_profile_user_id = $addedUser->id;
                    if ($this->User_Profiles->save($profile)) {
                    $email = new EmailForm();
                    $message = $fullname . ', your password for PUPQC Web Portal with username ' . $username . ' is: ' . $password; 
                    $email = new Email();
                    $email->transport('mail');
                    $email->from(['pup.maroon.cake@gmail.com' => 'PUPQC Web Portal'])
                    ->to('pup.maroon.cake@gmail.com') // change to recipicient
                    ->subject("Password for PUPQC Portal")
                    ->send($message);
                    $this->Flash->success('User Added!', [
                        'params' => [
                            'saves' => 'User Added!'
                            ]
                    ]);
                    return $this->redirect(['action' => 'employeesAll']);
                    }
                }
            }
            else {
                debug($employee->errors());
                $this->Flash->error(__('Unable to add user.'));
            }
        }
    }

    public function employeeEdit($user_employee_id)
    {       
        $this->header();
        $this->adminHeaderSidebar('users-employees');
        $this->title('Admin | Update User Employee');

        $this->loadModel('Users');
        $this->loadModel('User_Employees');
        $this->loadModel('EmployeePositionNames');
        $this->loadModel('User_Profiles');

        $employee = $this->User_Employees->find('all')->contain(["Users",'EmployeePositionNames'])->where(['User_Employees.user_employee_id' => $user_employee_id]);
        $this->set('employee',$employee->first());

        $employee_positions =  $this->EmployeePositionNames->find('list', ['keyField' => 'employee_position_id', 'valueField' => 'employee_position_name'])->where(['EmployeePositionNames.active' => 1])->order([
        'EmployeePositionNames.employee_position_priority' => 'ASC'
        ]);
        $this->set('employee_positions', $employee_positions);

        if ($this->request->is(['post', 'put'])) {

            $user_employee_lastname = $this->request->data['user_employee_lastname'];
            $user_employee_firstname = $this->request->data['user_employee_firstname'];
            $user_employee_middlename = $this->request->data['user_employee_middlename'];

        $email = $this->request->data['email'];
        $username = $this->request->data['username'];
        

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_employee_photo']['name'])) {
                    $file = $this->request->data['user_employee_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = $employee->first()->user_employee_photo;
                    }

            $employeesTable = TableRegistry::get('User_Employees');
            $usersTable = TableRegistry::get('Users');
            $profilesTable = TableRegistry::get('User_Profiles');
            $employeesTable = TableRegistry::getTableLocator()->get('User_Employees');
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $profilesTable = TableRegistry::getTableLocator()->get('User_Profiles');
            $employee = $employeesTable->get($user_employee_id);
            $user = $usersTable->get($employee->user_id);
            $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $employee->user_id])->first();
            $profile = $profilesTable->get($getProfile->user_profile_id);

            $user->email = $email;
            $user->username = $username;

            $employee->user_employee_lastname = $user_employee_lastname;
            $employee->user_employee_firstname = $user_employee_firstname;
            $employee->user_employee_middlename = $user_employee_middlename;
            $employee->user_employee_photo = $imageFileName;
            $employee->user_employee_position_id = $this->request->data(['user_employee_position_id']);

                $profile->user_profile_photo = $imageFileName;
            }

            if ($usersTable->save($user)) {
                if ($employeesTable->save($employee)) {
                    if ($profilesTable->save($profile)) {
                    $this->Flash->success('Employee Updated!', [
                    'params' => [
                        'saves' => 'Employee Updated!'
                        ]
                    ]);
                    return $this->redirect(['action' => 'employeesAll']);
                }
                }
            }
            else {
                $this->log($employee->errors(),'debug');
                    $this->Flash->success($admin->errors(), [
                    'params' => [
                        'saves' => $employee->errors()
                        ]
                    ]);
            }
            
        }
    }

    public function studentsAll() 
    {
        $this->header();
        $this->adminHeaderSidebar('user-students');
        $this->title('Admin | User Students');

        $this->loadModel("Users");
        $this->loadModel("User_Students");

        $students = $this->User_Students->find('all')->contain(["Users.UserTypes"])->where(['Users.active' => 1]);
        $students = $this->paginate($students);

        $this->set(compact('students'));
    }

    public function studentAdd()
    {       
        $this->header();
        $this->adminHeaderSidebar('user-students');
        $this->title('Admin | Add User: Student');

        $this->loadModel('Users');
        $this->loadModel('User_Students');
        $this->loadModel('User_Profiles');

        $student = $this->User_Students->Users->newEntity();
        $user = $this->Users->newEntity();
        $profile = $this->User_Profiles->newEntity();
        $this->set('student',$student);

        $this->loadModel('Courses');
        $courses =  $this->Courses->find('list', ['keyField' => 'course_id', 'valueField' => 'course_name'])->where(['Courses.active' => 1])->order(['Courses.course_name' => 'ASC']);
        $this->set('courses', $courses);

        if ($this->request->is('post')) {

            $user_student_lastname = $this->request->data['user_student_lastname'];
            $user_student_firstname = $this->request->data['user_student_firstname'];
            $user_student_middlename = $this->request->data['user_student_middlename'];
            $fullname = $user_student_lastname . ', ' . $user_student_firstname . ' ' . substr($user_student_middlename,0,1) . '.';

            $email = $this->request->data['email'];
            $username = $this->request->data['username'];
        
            $factory = new \RandomLib\Factory;
            $randomLength = rand(8,12);
            $alphanumeric = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUV0123456789';
            $generator = $factory->getMediumStrengthGenerator();
            $password = $generator->generateString($randomLength, $alphanumeric);
            $hasher = new DefaultPasswordHasher();
        
            // Get admin photo
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_student_photo']['name'])) {
                    $file = $this->request->data['user_student_photo']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);
                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = '_default.jpg';
                }

                $user->email = $email;
                $user->password = $hasher->hash($password);
                $user->username = $username;
                $user->active = 1;
                $user->user_type_id = 3;

                $student->user_student_lastname = $user_student_lastname;
                $student->user_student_firstname = $user_student_firstname;
                $student->user_student_middlename = $user_student_middlename;
                $student->user_student_photo = $imageFileName;
                $student->course_id = $this->request->data(['course_id']);
                $student->user_student_number = $this->request->data(['user_student_number']);         
        
                $profile->user_profile_photo = $imageFileName;
                $profile->user_cover_photo = 'default_user_cover.png';
                $profile->user_profile_background = 'white';
                $profile->user_profile_bio = '';   

                if (!empty($this->request->data['user_student_photo']['name'])) {
                    $student->user_student_photo = $imageFileName;
                }
            }

            if ($addedUser = $this->Users->save($user)) {
                $student->user_id = $addedUser->id;
                if ($this->User_Students->save($student)) {
                    $profile->user_profile_user_id = $addedUser->id;
                    if ($this->User_Profiles->save($profile)) {
                    $email = new EmailForm();
                    $message = $fullname . ', your password for PUPQC Web Portal with username ' . $username . ' is: ' . $password; 
                    $email = new Email();
                    $email->transport('mail');
                    $email->from(['pup.maroon.cake@gmail.com' => 'PUPQC Web Portal'])
                    ->to('pup.maroon.cake@gmail.com') // change to recipicient
                    ->subject("Password for PUPQC Portal")
                    ->send($message);
                    $this->Flash->success('User Added!', [
                        'params' => [
                            'saves' => 'User Added!'
                            ]
                    ]);
                    return $this->redirect(['action' => 'studentsAll']);
                    }
                }
            }
            else {
                debug($employee->errors());
                $this->Flash->error(__('Unable to add user.'));
            }
        }
    }

    public function studentEdit($user_student_id)
    {       
        $this->header();
        $this->adminHeaderSidebar('user-students');
        $this->title('Admin | Edit User: Student');

        $this->loadModel('Users');
        $this->loadModel('User_Students');
        $this->loadModel('Courses');
        $this->loadModel('User_Profiles');

        $student = $this->User_Students->find('all')->contain(["Users",'Courses'])->where(['User_Students.user_student_id' => $user_student_id]);
        $this->set('student',$student->first());

        $courses =  $this->Courses->find('list', ['keyField' => 'course_id', 'valueField' => 'course_name'])->where(['Courses.active' => 1])->order([
        'Courses.course_name' => 'ASC'
        ]);
        $this->set('courses', $courses);

        if ($this->request->is(['post', 'put'])) {

            $user_student_lastname = $this->request->data['user_student_lastname'];
            $user_student_firstname = $this->request->data['user_student_firstname'];
            $user_student_middlename = $this->request->data['user_student_middlename'];

            $email = $this->request->data['email'];
            $username = $this->request->data['username'];

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_student_photo']['name'])) {
                    $file = $this->request->data['user_student_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = $student->first()->user_student_photo;
                }

                $studentsTable = TableRegistry::get('User_Students');
                $usersTable = TableRegistry::get('Users');
                $profilesTable = TableRegistry::get('User_Profiles');
                $studentsTable = TableRegistry::getTableLocator()->get('User_Students');
                $usersTable = TableRegistry::getTableLocator()->get('Users');
                $profilesTable = TableRegistry::getTableLocator()->get('User_Profiles');
                $student = $studentsTable->get($user_student_id);
                $user = $usersTable->get($student->user_id);
                $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $student->user_id])->first();
                $profile = $profilesTable->get($getProfile->user_profile_id);

                $user->email = $email;
                $user->username = $username;

                $student->user_student_lastname = $user_student_lastname;
                $student->user_student_firstname = $user_student_firstname;
                $student->user_student_middlename = $user_student_middlename;
                $student->user_student_photo = $imageFileName;
                $student->course_id = $this->request->data(['course_id']);
                $student->user_student_number = $this->request->data(['user_student_number']);      

                $profile->user_profile_photo = $imageFileName;
            }

            if ($usersTable->save($user)) {
                if ($studentsTable->save($student)) {
                    if ($profilesTable->save($profile))  {
                    $this->Flash->success('Student Updated!', [
                    'params' => [
                       'saves' => 'Student Updated!'
                        ]
                    ]);
                    return $this->redirect(['action' => 'studentsAll']);
                    }
                }
            }
            else {
                $this->log($student->errors(),'debug');
                $this->Flash->success($student->errors(), [
                    'params' => [
                        'saves' => $student->errors()
                    ]
                ]);
            }
        } 
    }

    public function alumniAll() 
    {
        $this->header();
        $this->adminHeaderSidebar('user-alumni');
        $this->title('Admin | Users: Alumni');

        $this->loadModel("Users");
        $this->loadModel("User_Alumni");

        $alumni = $this->User_Alumni->find('all')->contain(["Users.UserTypes"])->where(['Users.active' => 1]);
        $alumni = $this->paginate($alumni);

        $this->set(compact('alumni'));
    }

    public function alumniAdd()
    {       
        $this->header();
        $this->adminHeaderSidebar('user-alumni');
        $this->title('Admin | Add User Alumni');

        $this->loadModel('Users');
        $this->loadModel('User_Alumni');
        $this->loadModel('User_Profiles');

        $alumni = $this->User_Alumni->Users->newEntity();
        $user = $this->Users->newEntity();
        $profile = $this->User_Profiles->newEntity();
        $this->set('alumni',$alumni);

        $this->loadModel('Courses');
        $courses =  $this->Courses->find('list', ['keyField' => 'course_id', 'valueField' => 'course_name'])->where(['Courses.active' => 1])->order([
        'Courses.course_name' => 'ASC'
        ]);
        $this->set('courses', $courses);

        if ($this->request->is('post')) {

            $user_alumni_lastname = $this->request->data['user_alumni_lastname'];
            $user_alumni_firstname = $this->request->data['user_alumni_firstname'];
            $user_alumni_middlename = $this->request->data['user_alumni_middlename'];
            $fullname = $user_alumni_lastname . ', ' . $user_alumni_firstname . ' ' . substr($user_alumni_middlename,0,1) . '.';

            $email = $this->request->data['email'];
            $username = $this->request->data['username'];
        
            $factory = new \RandomLib\Factory;
            $randomLength = rand(8,12);
            $alphanumeric = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUV0123456789';
            $generator = $factory->getMediumStrengthGenerator();
            $password = $generator->generateString($randomLength, $alphanumeric);
            $hasher = new DefaultPasswordHasher();
        
            // Get admin photo
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_alumni_photo']['name'])) {
                    $file = $this->request->data['user_alumni_photo']; 
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);
                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);
                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = '_default.jpg';
                }

                $user->email = $email;
                $user->password = $hasher->hash($password);
                $user->username = $username;
                $user->active = 1;
                $user->user_type_id = 4;

                $alumni->user_alumni_lastname = $user_alumni_lastname;
                $alumni->user_alumni_firstname = $user_alumni_firstname;
                $alumni->user_alumni_middlename = $user_alumni_middlename;
                $alumni->user_alumni_photo = $imageFileName;
                $alumni->course_id = $this->request->data(['course_id']);
                $alumni->user_alumni_student_number = $this->request->data(['user_alumni_student_number']);
                $alumni->user_alumni_year_graduated = $this->request->data(['user_alumni_year_graduated']);
        
                $profile->user_profile_photo = $imageFileName;
                $profile->user_cover_photo = 'default_user_cover.png';
                $profile->user_profile_background = 'white';
                $profile->user_profile_bio = '';

                if (!empty($this->request->data['user_alumni_photo']['name'])) {
                    $alumni->user_alumni_photo = $imageFileName;
                }
            }

            if ($addedUser = $this->Users->save($user)) {
                $alumni->user_id = $addedUser->id;
                if ($this->User_Alumni->save($alumni)) {
                    $profile->user_profile_user_id = $addedUser->id;
                    if ($this->User_Profiles->save($profile)) {
                    $email = new EmailForm();
                    $message = $fullname . ', your password for PUPQC Web Portal with username ' . $username . ' is: ' . $password; 
                    $email = new Email();
                    $email->transport('mail');
                    $email->from(['pup.maroon.cake@gmail.com' => 'PUPQC Web Portal'])
                    ->to('pup.maroon.cake@gmail.com') // change to recipicient
                    ->subject("Password for PUPQC Portal")
                    ->send($message);
                    $this->Flash->success('User Added!', [
                        'params' => [
                            'saves' => 'User Added!'
                            ]
                    ]);
                    return $this->redirect(['action' => 'alumniAll']);
                    }
                }
            }
            else {
                debug($employee->errors());
                $this->Flash->error(__('Unable to add user.'));
            }
        }
    }

    public function alumniEdit($user_alumni_id)
    {       
        $this->header();
        $this->adminHeaderSidebar('user-alumni');
        $this->title('Admin | Update User Alumni');

        $this->loadModel('Users');
        $this->loadModel('User_Alumni');
        $this->loadModel('Courses');
        $this->loadModel('User_Profiles');

        $alumni = $this->User_Alumni->find('all')->contain(["Users",'Courses'])->where(['User_Alumni.user_alumni_id' => $user_alumni_id]);
        $this->set('alumni',$alumni->first());

        $courses =  $this->Courses->find('list', ['keyField' => 'course_id', 'valueField' => 'course_name'])->where(['Courses.active' => 1])->order([
        'Courses.course_name' => 'ASC'
        ]);
        $this->set('courses', $courses);

        if ($this->request->is(['post', 'put'])) {

            $user_alumni_lastname = $this->request->data['user_alumni_lastname'];
            $user_alumni_firstname = $this->request->data['user_alumni_firstname'];
            $user_alumni_middlename = $this->request->data['user_alumni_middlename'];

        $email = $this->request->data['email'];
        $username = $this->request->data['username'];
        

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_alumni_photo']['name'])) {
                    $file = $this->request->data['user_alumni_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                    }
                }
                else {
                    $imageFileName = $alumni->first()->user_alumni_photo;
                }

                $alumniTable = TableRegistry::get('User_Alumni');
                $usersTable = TableRegistry::get('Users');
                $profilesTable = TableRegistry::get('User_Profiles');
                $alumniTable = TableRegistry::getTableLocator()->get('User_Alumni');
                $usersTable = TableRegistry::getTableLocator()->get('Users');
                $profilesTable = TableRegistry::getTableLocator()->get('User_Profiles');
                $alumni = $alumniTable->get($user_alumni_id);
                $user = $usersTable->get($alumni->user_id);
                $getProfile = $this->User_Profiles->find('all')->where(['User_Profiles.user_profile_user_id' => $alumni->user_id])->first();
                $profile = $profilesTable->get($getProfile->user_profile_id);

                $user->email = $email;
                $user->username = $username;
                
                $alumni->user_alumni_lastname = $user_alumni_lastname;
                $alumni->user_alumni_firstname = $user_alumni_firstname;
                $alumni->user_alumni_middlename = $user_alumni_middlename;
                $alumni->user_alumni_photo = $imageFileName;
                $alumni->course_id = $this->request->data(['course_id']);

                $profile->user_profile_photo = $imageFileName;
            }

            if ($usersTable->save($user)) {
                if ($alumniTable->save($alumni)) {
                    if ($profilesTable->save($profile))  {
                    $this->Flash->success('Student Updated!', [
                    'params' => [
                        'saves' => 'Alumni Updated!'
                        ]
                    ]);
                    return $this->redirect(['action' => 'alumniAll']);
                    }
                }
            }
            else {
                $this->log($alumni->errors(),'debug');
                    $this->Flash->success($alumni->errors(), [
                    'params' => [
                        'saves' => $alumni->errors()
                        ]
                    ]);
            }
            
        }
    }

    public function deleteUser()
    {   
        $this->header();
        $this->loadModel('Users');
        
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {


            $user_id = $this->request->data('user_id');

            $usersTable = TableRegistry::get('Users');
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $usersTable->get($user_id);

            $user->active = 0;


            if ($usersTable->save($user)) {
                $this->Flash->success('User Removed!', [
                    'params' => [
                        'saves' => 'User Removed!!'
                        ]
                    ]);
            }
            else {
                debug($number->errors());
                $this->Flash->success('User Removed!' . $user->errors() . '#' . $admin->errors(), [
                    'params' => [
                        'saves' => 'User Removed!!' . $user->errors() . '#' . $admin->errors()
                        ]
                    ]);
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
    }

    public function user()
    {
        $this->header();
        if ($this->request->is('post')) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_photo']['name'])) {
                    $file = $this->request->data['user_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = 'default_user_photo.png';
                    }

                

            $usersTable = TableRegistry::get('Users');

            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $usersTable->get($this->Auth->user('id'));

            $current_password = $this->request->data['current_password'];

            if ((new DefaultPasswordHasher)->check($current_password, $user->password)) {

                $user->email = $this->request->data['email'];
                $user->password = $this->request->data['new_password'];
                $user->user_photo = $imageFileName;

                 if ($usersTable->save($user)) {
                    $this->Flash->success('User Updated!', [
                    'params' => [
                        'saves' => 'Password Updated!'
                        ]
                    ]);
                }
                else {
                    $this->log($usersTable->errors(),'debug');
                    $this->Flash->error(__('Unable to add your article.'));
                }
            }
            else {
                    $this->Flash->error('Incorrect Password', [
                    'params' => [
                        'saves' => 'Incorrect Password!'
                        ]
                    ]);
            }
            
        }
    }
    }

    public function profile()
    {    
        $this->adminProfileSideBar('profile');
        
        $user = $this->Users->find('all')->where(['Users.id'=>$this->Auth->user('id')]);
        $this->set('user',$user);
        $row = $user->first();

        if ($this->request->is(['post', 'put'])) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_photo']['name'])) {
                    $file = $this->request->data['user_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = $row->user_photo;
                    }

                

            $usersTable = TableRegistry::get('Users');

            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $users = $usersTable->get($this->Auth->user('id'));

            $current_password = $this->request->data['current_password'];

            if ((new DefaultPasswordHasher)->check($current_password, $users->password)) {

                $users->email = $this->request->data['email'];
                $users->user_photo = $imageFileName;

                 if ($usersTable->save($users)) {
                    $this->Flash->success('User Profile Updated!', [
                    'params' => [
                        'saves' => 'User Profile Updated!'
                        ]
                    ]);
                    return $this->redirect(['action' => 'profile', $this->Auth->user('id')]);
                }
                else {
                    $this->Flash->error('Unable to update', [
                    'params' => [
                        'saves' => 'Unable to update!'
                        ]
                    ]);
                }
            }
            else {
                    $this->Flash->success('Incorrect Password', [
                    'params' => [
                        'saves' => 'Incorrect Password!'
                        ]
                    ]);
            }
            
        }
    }


    }

    public function changePassword() {
        $this->adminProfileSideBar('password');

        $user = $this->Users->find('all')->where(['Users.id'=>$this->Auth->user('id')]);
        $this->set('user',$user);
        $row = $user->first();

        if ($this->request->is(['post', 'put'])) {

            $usersTable = TableRegistry::get('Users');

            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $users = $usersTable->get($this->Auth->user('id'));

            $current_password = $this->request->data['current_password'];

            if ((new DefaultPasswordHasher)->check($current_password, $users->password)) {

                $users->password = $this->request->data['new_password'];

                 if ($usersTable->save($users)) {
                    $this->Flash->success('User Updated!', [
                    'params' => [
                        'saves' => 'Password Updated!'
                        ]
                    ]);
                return $this->redirect(['action' => 'changePassword', $this->Auth->user('id')]);
                }
                else {
                debug($event->errors());
                $this->Flash->error(__('Unable to add your article.'));
                }
            }
            else {
                    $this->Flash->error('incorrect Password', [
                    'params' => [
                        'saves' => 'incorrect Password!'
                        ]
                    ]);
            }
      }      
        $this->set('user',$user);
    }

    public function register()
    {    
        $this->adminProfileSideBar('register');
        $user = $this->Users->newEntity();

        if ($this->request->is(['post'])) {

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['user_photo']['name'])) {
                    $file = $this->request->data['user_photo']; //put the data into a var for easy use

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/upload/' . $setNewFileName . '.' . $ext);

                        //prepare the filename for database entry 
                        $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
                    else {
                        $imageFileName = '_default.png';
                    }


                $user->email = $this->request->data['email'];
                $user->user_photo = $imageFileName;
                $user->password = $this->request->data['password'];

                 if ($this->Users->save($user)) {
                    $this->Flash->success('User Added!', [
                    'params' => [
                        'saves' => 'User Added!'
                        ]
                    ]);
                    //return $this->redirect(['action' => 'profile', $this->Auth->user('id')]);
                }
                else {
                    $this->Flash->error('Unable to update', [
                    'params' => [
                        'saves' => 'Unable to update!'
                        ]
                    ]);
                }
            
        }
    }

    $this->set('user', $user);

    }


    public function isAuthorized($user) {

    if (in_array($this->request->action, ['forumCategories', 'forumAddCategory','forumEditCategory','forumDeleteCategory','profile','register','adminAll','adminAdd','adminEdit','adminDelete','employeesAll','employeeAdd','employeeEdit','studentsAll','studentAdd','studentEdit','alumniAll','alumniAdd','alumniEdit','deleteUser'])) {
        return true;
    }

        return parent::isAuthorized($user);
    }
}
