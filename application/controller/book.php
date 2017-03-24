<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 20.03.17
 * Time: 17:09
 */

class Book extends Controller
{
    public $payment;
    public $category;
    public $direct;

    function __construct()
    {
        parent::__construct();
        $this->payment = $this->loadModel('payment');
        $this->category = $this->loadModel('category');
        $this->direct = $this->loadModel('direct');

    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        $payments = $this->payment->getAllPayments();

        $categories = $this->category->getAllCategories();
        $categories = Helper::mapModel($categories, 'id', 'name');

        $directs = $this->direct->getAllDirects();
        $directs = Helper::mapModel($directs, 'id', 'name');

        $filter_directs = Helper::addNullRowArray($directs);
        $filter_categories = Helper::addNullRowArray($categories);
        $filter_sort = Helper::getFilterSortArray();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/book/index.php';
        require APP . 'view/_templates/footer.php';
    }

    ////////////////// AJAX FUNCTIONS //////////////

    public function ajaxGetCategoryList(){
        $categories = $this->category->getAllCategories();
        require APP. 'view/book/wrappers/categorylist.php';
    }

    public function ajaxGetPaymentsList(){
        if(isset($_POST['with_filters'])){
            $filter_params = [];
            $period = $_POST['period'];
            $filter_params['date_start'] = $_POST['date_start'];
            $filter_params['date_end'] = $_POST['date_end'];
            $filter_params['category_id'] = $_POST['category_id'];
            $filter_params['direct_id'] = $_POST['direct_id'];
            $filter_params['summ'] = $_POST['summ'];
            $filter_params['sort'] = $_POST['sort'];
            $filter_params['sort_option'] = $_POST['sort_option'];
            if($period!=0){
                if(($period!=9)&&$filter_params['date_start']==''&&$filter_params['date_end']==''){
                    $time = Helper::set_time_array($period);
                    $filter_params['date_start'] = $time[0];
                    $filter_params['date_end'] = $time[1];
                }
            }
            $payments = $this->payment->getAllPayments($filter_params);
            require APP. 'view/book/wrappers/paymentlist.php';
            exit();
        }
        $payments = $this->payment->getAllPayments();
        require APP. 'view/book/wrappers/paymentlist.php';
    }

    public function ajaxGetAdminRow($payment_id){
        $payment = $this->payment->getPaymentById($payment_id);

        $categories = $this->category->getAllCategories();
        $categories = Helper::mapModel($categories, 'id', 'name');

        $directs = $this->direct->getAllDirects();
        $directs = Helper::mapModel($directs, 'id', 'name');
        require APP. 'view/book/wrappers/ajaxpaymentrow.php';
    }

    public function ajaxNormalPaymentRow($payment_id){
        $payment = $this->payment->getPaymentById($payment_id);
        require APP. 'view/book/wrappers/normalpaymentrow.php';
    }

    public function updateRowByAjax($id){
        if(isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])){
            $pk = htmlspecialchars($_POST['pk'], ENT_QUOTES, 'UTF-8');
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $value = htmlspecialchars($_POST['value'], ENT_QUOTES, 'UTF-8');
            $answer = $this->payment->updateValueById($pk, $name, $value);
            echo $answer;
        }
    }
    ////////////////// END AJAX FUNCTIONS //////////


    ////////////////// CRUD FUNCTIONS //////////////
    public function addExpense(){
        if(isset($_POST['submit_add_expense']) && isset($_POST['Payment'])){
            if(!$this->payment->addPayment($_POST['Payment'])){
                header('location: ' . URL . 'problem/dbError');
                exit();
            }
        }
        header('location: ' . URL . 'book/index');
    }


    public function deleteExpence($id){
        if(isset($id)){
            $this->payment->deletePayment($id);
        }

        header('location: ' . URL . 'book/index');
    }

    public function deleteCategory($id){
        if(isset($id)){
            if(!$this->category->deleteCategory($id)){
                header('location: ' . URL . 'problem/dbError');
                exit();
            }
        }

        header('location: ' . URL . 'book/index');
    }

    public function addCategory(){
        if(isset($_POST['submit_add_category']) && isset($_POST['Category'])){
            if(!$this->category->addCategory($_POST['Category'])){
                header('location: ' . URL . 'problem/dbError');
                exit();
            }
        }
        header('location: ' . URL . 'book/index');
    }

    ///////////////////// END CRUD FUNCTIONS //////////////
}