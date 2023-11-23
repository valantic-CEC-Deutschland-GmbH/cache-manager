<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Communication\Controller;

use Generated\Shared\Transfer\CacheManagerDeleteTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \ValanticSpryker\Zed\CacheManagerGui\Business\CacheManagerGuiFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    private const NAME_PARAMETER = 'name';

    private const CACHE_MANAGER_GUI_URL = '/cache-manager-gui';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request): array
    {
        $transfers = $this->getFacade()->getCacheManagerPluginsData();

        return $this->viewResponse([
            'pluginData' => $transfers,
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request): RedirectResponse
    {
        $name = $request->get(self::NAME_PARAMETER);

        $deleteTransfer = (new CacheManagerDeleteTransfer())->setName($name);
        $deleteTransfer = $this->getFacade()->deleteCache($deleteTransfer);

        if ($deleteTransfer->getSuccess()) {
            $this->addSuccessMessage(sprintf('Deleted %s entries for %s', $deleteTransfer->getAmount(), $name));
        } else {
            $this->addErrorMessage('Error deleting entries for name ' . $name);
        }

        return $this->redirectResponse(self::CACHE_MANAGER_GUI_URL);
    }
}
