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
class TestsController extends AppController
{

    public function initialize()
    {
        $this->loadComponent('Paginator');
        $this->loadModel("Users");
        parent::initialize();
        $this->adminSideBarHasSub('users');
        $this->title('Admin | Emails');
    }

    public function adminHeaderTest()
    {
        $user =  $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')]);
        $this->set('user', $user->first());
    }

    public function adminContentTest()
    {
        $user =  $this->Users->find('all')->where(['Users.id' => $this->Auth->user('id')]);
        $this->set('user', $user->first());
    }

    public function add()
    {

    }


    
    public function addEmail()
    {   
        $this->loadModel("ContactEmails");

        $this->layout = false;
        $this->autoRender = false;

        $email = $this->ContactEmails->newEntity();

        if ($this->request->is('post')) {

            $email->contact_email = $this->request->getData('email');
            $email->active = 1;

            if ($saved = $this->ContactEmails->save($email)) {
                $this->Flash->success('Email Added!', [
                    'params' => [
                        'saves' => 'Email Added!'
                        ]
                    ]);
            }
            else {
                debug($email->errors());
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
        $this->set('email', $email);

    }


    
    public function updateEmail()
    {        
        $this->loadModel("ContactEmails");

        $this->layout = false;
        $this->autoRender = false;

        $contact_email_id = $this->request->getData('contact_email_id');

        if ($this->request->is(['post', 'put'])) {

            $emailsTable = TableRegistry::get('ContactEmails');

            $emailsTable = TableRegistry::getTableLocator()->get('ContactEmails');
            $email = $emailsTable->get($contact_email_id);

            $email->contact_email = $this->request->getData('email');

            if ($emailsTable->save($email)) {
                $this->Flash->success('Email Updated!', [
                    'params' => [
                        'saves' => 'Email Updated!'
                        ]
                    ]);
            }
            else {
                $this->Flash->error(__('Unable to add your article.'));
            }
            
        }
        // Get a list of tags.

    }

    
    public function adminAllUsersTest()
    {        
        $this->adminHeaderSidebar('users-admin');
        $this->title('Admin | All Users');

        $this->loadModel("Users");
        $this->loadModel("User_Administrators");

        $admins = $this->User_Administrators->find('all')->contain(["Users.UserTypes"])->where(['Users.active' => 1]);
        $admins = $this->paginate($admins);

        $this->set(compact('admins'));
    }

    
    public function adminViewUserTest()
    {        
        $this->adminHeaderSidebar('users-admin');
        $this->title('Admin | View User'); // change to user's name
    }

    public function adminAddUserTest()
    {       
        $this->adminHeaderSidebar('users-admin');
        $this->title('Admin | Add User');

    	$this->loadModel('Users');
    	$this->loadModel('User_Administrators');

        $admin = $this->User_Administrators->Users->newEntity();
        $user = $this->Users->newEntity();
        $this->set('admin',$admin);

        if ($this->request->is('post')) {

        	$admin_lastname = $this->request->data['admin_lastname'];
        	$admin_firstname = $this->request->data['admin_firstname'];
        	$admin_middlename = $this->request->data['admin_middlename'];
        	$fullname = $admin_lastname . ', ' . $admin_firstname . ' ' . substr($admin_middlename,0,1) . '.';

        	$email = $this->request->data['email'];
        
        	$factory = new \RandomLib\Factory;
        	$randomLength = rand(8,12);
        	$alphanumeric = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUV0123456789';
			$generator = $factory->getMediumStrengthGenerator();
			$admin_password = $generator->generateString($randomLength, $alphanumeric);
			$hasher = new DefaultPasswordHasher();
		
			// Get admin photo
			if (!empty($this->request->data)) {
				if (!empty($this->request->data['admin_photo']['name'])) {
					$file = $this->request->data['admin_photo']; 
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
        		$user->password = $hasher->hash($admin_password);
        		$user->active = 1;
        		$user->user_type_id = 1;

            	$admin->admin_lastname = $admin_lastname;
            	$admin->admin_firstname = $admin_firstname;
            	$admin->admin_middlename = $admin_middlename;
            	$admin->admin_username = $this->request->data['admin_username'];
            	$admin->admin_photo = $imageFileName;
            
            	$admin->admin_active = 1;

            	if (!empty($this->request->data['admin_photo']['name'])) {
            		$admin->admin_photo = $imageFileName;
            	}
        	}

        	if ($addedUser = $this->Users->save($user)) {
        		$admin->user_id = $addedUser->id;
        		if ($this->User_Administrators->save($admin)) {
                	$email = new EmailForm();
                	$message = $fullname . ', your password for PUPQC Web Portal is: ' . $admin_password; 
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
                	return $this->redirect(['action' => 'adminAllUsersTest']);
            	}
        	}
        	else {
        		debug($admin->errors());
        		$this->Flash->error(__('Unable to add user.'));
        	}
    	}
    }

    public function adminEditUserTest($admin_id)
    {       
        $this->adminHeaderSidebar('users-admin');
        $this->title('Admin | Update User');

    	$this->loadModel('Users');
    	$this->loadModel('User_Administrators');

        $admin = $this->User_Administrators->find('all')->contain(["Users"])->where(['User_Administrators.admin_id' => $admin_id]);
        $this->set('admin',$admin->first());

        if ($this->request->is(['post', 'put'])) {


        $email = $this->request->data['email'];
		

            if (!empty($this->request->data)) {
                if (!empty($this->request->data['admin_photo']['name'])) {
                    $this->log('Got here', 'debug');
                    $file = $this->request->data['admin_photo']; //put the data into a var for easy use

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
                        $imageFileName = $admin->first()->admin_photo;
                    }

            $adminsTable = TableRegistry::get('User_Administrators');
            $usersTable = TableRegistry::get('Users');
            $adminsTable = TableRegistry::getTableLocator()->get('User_Administrators');
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $admin = $adminsTable->get($admin_id);
            $user = $usersTable->get($admin->user_id);

        	$user->email = $email;

            $admin->admin_lastname = $this->request->data['admin_lastname'];
            $admin->admin_firstname = $this->request->data['admin_firstname'];
            $admin->admin_middlename = $this->request->data['admin_middlename'];
            $admin->admin_username = $this->request->data['admin_username'];
            $admin->admin_photo = $imageFileName;
            
            }

            if ($usersTable->save($user)) {
                if ($adminsTable->save($admin)) {
                	$this->Flash->success('User Updated!', [
                    'params' => [
                        'saves' => 'User Updated!'
                        ]
                    ]);
                	return $this->redirect(['action' => 'adminAllUsersTest']);
            	}
            }
            else {
                $this->log($admin->errors(),'debug');
                	$this->Flash->success($admin->errors(), [
                    'params' => [
                        'saves' => $admin->errors()
                        ]
                    ]);
            }
            
        }
    }

    public function delete()
    {   
    	$this->loadModel('Users');
    	
        $this->layout = false;
        $this->autoRender = false;

        if ($this->request->is(['post', 'put'])) {


            $user_id = $this->request->data('user_id');

            $this->log('Got here ' . $user_id, 'debug');

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

    public function adminStudentsAllTest() 
    {
        $this->adminHeaderSidebar('user-students');
        $this->title('Admin | User Students');

        $this->loadModel("Users");
        $this->loadModel("User_Students");

        $students = $this->User_Students->find('all')->contain(["Users.UserTypes"])->where(['Users.active' => 1]);
        $students = $this->paginate($students);

        $this->set(compact('students'));
    }

    public function adminStudentAddTest()
    {       
        $this->adminHeaderSidebar('user-students');
        $this->title('Admin | Add User Student');

    	$this->loadModel('Users');
    	$this->loadModel('User_Students');

        $student = $this->User_Students->Users->newEntity();
        $user = $this->Users->newEntity();
        $this->set('student',$student);

        $this->loadModel('Courses');
        $courses =  $this->Courses->find('list', ['keyField' => 'course_id', 'valueField' => 'course_name'])->where(['Courses.active' => 1])->order([
        'Courses.course_name' => 'ASC'
        ]);
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
        		$user->user_type_id = 1;

            	$student->user_student_lastname = $user_student_lastname;
            	$student->user_student_firstname = $user_student_firstname;
            	$student->user_student_middlename = $user_student_middlename;
            	$student->user_student_photo = $imageFileName;
            	$student->course_id = $this->request->data(['course_id']);
            

            	if (!empty($this->request->data['user_student_photo']['name'])) {
            		$student->user_student_photo = $imageFileName;
            	}
        	}

        	if ($addedUser = $this->Users->save($user)) {
        		$student->user_id = $addedUser->id;
        		if ($this->User_Students->save($student)) {
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
                	return $this->redirect(['action' => 'adminStudentsAllTest']);
            	}
        	}
        	else {
        		debug($employee->errors());
        		$this->Flash->error(__('Unable to add user.'));
        	}
    	}
    }

    public function adminStudentEditTest($user_student_id)
    {       
        $this->adminHeaderSidebar('user-students');
        $this->title('Admin | Update User Student');

    	$this->loadModel('Users');
    	$this->loadModel('User_Students');
    	$this->loadModel('Courses');

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
            $studentsTable = TableRegistry::getTableLocator()->get('User_Students');
            $usersTable = TableRegistry::getTableLocator()->get('Users');
            $student = $studentsTable->get($user_student_id);
            $user = $usersTable->get($student->user_id);

        	$user->email = $email;
        	$user->username = $username;

            

            	$student->user_student_lastname = $user_student_lastname;
            	$student->user_student_firstname = $user_student_firstname;
            	$student->user_student_middlename = $user_student_middlename;
            	$student->user_student_photo = $imageFileName;
            	$student->user_student_position_id = $this->request->data(['course_id']);
            }

            if ($usersTable->save($user)) {
                if ($studentsTable->save($student)) {
                	$this->Flash->success('Student Updated!', [
                    'params' => [
                        'saves' => 'Student Updated!'
                        ]
                    ]);
                	return $this->redirect(['action' => 'adminStudentsAllTest']);
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

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        $this->loadModel('Users');
        $user_type = $this->Users->find('all')->contain(["UserTypes"])->where(['Users.id' => $this->Auth->user('id')])->first();
        $this->log($user_type->user_type->user_type_name, 'debug');
        if ($user_type->user_type->user_type_name != 'Administrator') {
            return false;
        }
        else if (in_array($action, ['adminHeaderTest','add','adminContentTest','addEmail','updateEmail','adminStudentsAllTest','adminStudentAddTest','adminStudentEditTest','adminAddUserTest','delete','adminEmployeeAllTest','adminEmployeeAddTest','adminEmployeeEditTest'])) {
            return true;
        }

    }

}
