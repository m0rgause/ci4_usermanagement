<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\GroupAccessModel;
use App\Models\GroupModel;

class AuthGuard implements FilterInterface
{
    protected $GroupAccessModel;
    protected $GroupModel;

    public function __construct()
    {
        $this->GroupAccessModel = new GroupAccessModel();
        $this->GroupModel = new GroupModel();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()
                ->to('signin')
                ->with('error', 'Silahkan login terlebih dahulu');
        } else {
            // checking expired token  
            $session = session();
            $expires_in = $session->get('expires_in');
            $current_time = time();

            if ($expires_in < $current_time) {
                $session->destroy();
                return redirect()
                    ->to('signin')
                    ->with('error', 'Sesi login telah berakhir, silahkan login kembali');
            }

            $uri = service('uri');
            $controller = $uri->getSegment(1);
            $group_id = session()->get('group_id');

            $groupAccess = $this->GroupAccessModel->join('access_path', 'group_access.access_id = access_path.id')->where(['group_id' => $group_id, 'link' => $controller])->first();


            if (empty($groupAccess)) {
                $landingPage = $this->GroupModel->select('landing_page')->where('id', $group_id)->first();
                return redirect()->to($landingPage['landing_page']);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
