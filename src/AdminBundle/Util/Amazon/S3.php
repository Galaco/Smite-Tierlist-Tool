<?php
 
namespace AdminBundle\Util\S3;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Doctrine\ORM\EntityManager;
 
class S3
{
    private $_container;
    private $_s3;
    private $_bucket;
    private $_bucketName;
 
    // notice that we're injecting service-container to be able to get other symfony2 services
    public function __construct(Container $serviceContainer)
    {
        $this->_container = $serviceContainer;	
		$this->_s3 = $serviceContainer->get('aws_s3');
		$this->_s3->setRegion('s3-eu-west-1.amazonaws.com');
        $this->_bucketName = $serviceContainer->getParameter('smite_aws_s3_bucket');
		$this->_bucket = $this->_bucketName . strtolower($this->_s3->key);
    }
	
	public function getBucketName()
	{
		return 'http://' . $this->_bucketName;
	}
	
	public function uploadToBucket($source, $destination) 
	{
		if (!$this->checkFileExists($destination)) {
			$query = $this->requestRemoteFile($source);
			if ($query) {			
				return $this->uploadFile($query, $destination)->isOK();
			} else {
				return false;
			}
		}
		return true;
	}
	
	public function checkFileExists($file) 
	{
		$response = $this->_s3->if_object_exists($this->_bucketName, $file);
		return $response;
	}
	
	private function uploadFile($data, $destination)
	{
		$response =  $this->_s3->createObject($this->_bucketName, $destination, [
			'body' => $data,
			'acl' => 'public-read',
			'contentType' => $this->determineMimeType($destination),
		]);
		return $response;
	}
	
	private function requestRemoteFile($source)
	{
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $source);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
		$query = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		return $query;
	}
	
	private function determineMimeType($file)
	{
		$ext = substr($file, strrpos($file, '.') + 1);
		switch ($ext) {
			case 'jpeg': case 'jpg':
				return 'image/jpeg';
			case 'png':
				return 'image/png';
			default:
				return 'application/octet-stream';
		}
	}
}