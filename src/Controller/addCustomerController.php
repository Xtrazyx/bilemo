<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 12/01/2018
 * Time: 12:03
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Customer;

/**
 * Class addCustomerController
 */
class addCustomerController extends Controller
{
    /**
     * @Route(
     *     name="post_customer",
     *     path="/api/customers",
     *     defaults={ "_api_resource_class" = Customer::class, "_api_collection_operation_name" = "create_customer"},
     *    methods="POST"
     * )
     *
     * @param Customer $data
     * @return mixed
     */
    public function addCustomerAction(Customer $data)
    {
        // Getting authorized user
        $company = $this->getUser();

        $userCompanyURI = '/api/companies/' . $company->getId();

        if($company->getId() != $data->getCompany()->getId()){
            return new JsonResponse(
                array(
                    "code" => "403",
                    "message" => "Your are not allowed to create customer for another company. Check your company Id",
                    "your company Id URI" => $userCompanyURI
                ),
                403
            );
        }

        return $data;
    }
}
