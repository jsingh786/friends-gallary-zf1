<?php
class DevController extends Zend_Controller_Action
{
	public function preDispatch()
	{

	}

	public function init()
	{
		if(!Service\Authentication::hasIdentity())
       {
           $this->_helper->redirector ('index', 'authenticate');
       }
		/* Initialize action controller here */
	}

	public function indexAction()
	{

	}

	/**
	 * for getting filename of all the files present in the Enitites folder.
	 * And return values in the $fileNames array.
	 *
	 * @author jsingh7
	 * @version 1.1
	 *
	 */
	public function generatedbAction()
	{
		$entities_path = $_SERVER["DOCUMENT_ROOT"].'/'.PROJECT_NAME.'application/models/Entities/';
		$d = dir($entities_path) or die("Wrong path: $entities_path");
		while (false !== ($entry = $d->read()))
		{
			if($entry != '.' && $entry != '..' && !is_dir($entry))
				$fileNames[] = str_replace(".php","",$entry);
		}

		// generate database from model files...
		$em = Zend_Registry::get('em');
		$tool = new \Doctrine\ORM\Tools\SchemaTool($em);
		foreach($fileNames as $key=>$v)
		{
			$filepaths = "Entities\\".$v;
			$classes = array(
				$em->getClassMetadata($filepaths)
			);
			$tool->createSchema($classes);
		}

		$d->close();

		echo "<h2 style ='color:green'>Tables generated successfully.</h2><br>";
		echo "<img src = '".IMAGE_PATH."/static/doctrine2.png'><br>";
		echo "<h3>Want to know more about Doctrine-2 ORM?<br> Visit : <a href ='http://doctrine-orm.readthedocs.org/en/latest/'>http://doctrine-orm.readthedocs.org/en/latest/</a><h3>";

		die;
	}

	/**
	 * Generates proxies when to run on production mode.
	 * i.e autogenerateproxies false.
	 * @author jsingh7
	 *
	 */
	public function generateProxiesAction()
	{
		$em = Zend_Registry::get('em');
		$proxyFactory = $em->getProxyFactory();
		$metadatas = $em->getMetadataFactory()->getAllMetadata();
		$proxyFactory->generateProxyClasses($metadatas, APPLICATION_PATH . '/models/Proxies');

		echo "<h2 style ='color:green'>Your doctrine proxies has been created.</h2>";

		echo "<img src = '".IMAGE_PATH."/static/doctrine.png'>";

		echo "<h3>What are doctrine proxies?";
		echo "<h3>A Doctrine proxy is just a wrapper that extends an entity class to provide Lazy Loading for it.

 By default, when you ask the Entity Manager for an entity that is associated with another entity, the associated entity won't be loaded from the database, but wrapped into a proxy object. When your application then requests a property or calls a method of this proxied entity, Doctrine will load the entity from the database (except when you request the ID, which is always known to the proxy).

 This happens fully transparent to your application due to the fact that the proxy extends your entity class.

 Doctrine will by default hydrate associations as lazy load proxies if you don't JOIN them in your query or set the fetch mode to EAGER.

    	<h3>";

		echo "<img src = '".IMAGE_PATH."/static/doctrine_lazy_loading.png'>";

		echo "<h3>Want to know more about doctrine proxy classes?<br> Visit : <a href ='http://doctrine-orm.readthedocs.org/en/latest/reference/advanced-configuration.html'>http://doctrine-orm.readthedocs.org/en/latest/reference/advanced-configuration.html</a><h3>";

		die;
	}

	/**
	 * Use this when using autogenerateproxies false,
	 * After altering that database.
	 *
	 * @author jsingh7
	 *
	 */
	public function clearApcCacheAction()
	{
		/*$cacheDriver = new \Doctrine\Common\Cache\ApcCache();
        $cacheDriver->flushAll();*/

		apc_clear_cache();

		echo "<h2 style ='color:green'>Your APC cache has been cleared for doctrine.</h2>";

		echo "<h3>Want to know more about APC cache?<br> Visit : <a href ='http://php.net/manual/en/book.apc.php'>http://php.net/manual/en/book.apc.php</a><h3>";

		echo "<img src = '".IMAGE_PATH."/static/php-apc-cache.png'>";
		die;
	}

	public function testAction()
	{
		\Extended\users::get(['id'=>143, 'fname'=>'Jaskaran'],
							['limit'=>1, 'offset'=>0],
							['order'=>'DESC', 'column'=>'id']);
	}
}





