<?php

namespace Salexandru\Controller\Routing;

use Salexandru\Http\Request;

interface RouterInterface
{

    public function discoverHandlerFor(Request $request);

}
