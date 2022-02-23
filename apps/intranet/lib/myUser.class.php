<?php

class myUser extends sfGuardSecurityUser
{
  public function getCommercial()
  {
    return ($u = $this->getGuardUser()) ? $u->getCommercial() : null;
  }
}
