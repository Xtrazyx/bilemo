<?php
/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 13/01/2018
 * Time: 19:35
 */

namespace App\Security;

use App\Entity\Company;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CompanyVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW))) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof Company) {
            // the user must be logged in; if not, deny access
            return false;
        }

        $id = $subject;

        return $this->canView($id, $user);
    }

    private function canView($id, Company $authCompany)
    {
        // The given
        if ($id == $authCompany->getId()) {
            return true;
        }

        return false;
    }

}
