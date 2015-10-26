<?php
//include_once 'FCPATH/texifier/vendor/autoload.php';

use Aws\S3\S3Client;
use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

class Test extends CI_Controller
{
    function Test()
    {
        //changed for new version
        parent::__construct();
        
        $this->edit_allowed = true;
        $this->load->helper('basics');
        $this->load->helper('utilities');
        $this->load->helper('file');
        // $session=$this->session;
        // echo $this->user=$this->session->userdata('DX_username');
    }
    public function index()
    {
        $browser  = new Buzz\Browser();
        $response = $browser->get('http://www.google.com');
        
        echo $browser->getLastRequest() . "\n";
        echo $response;
    }
    
    /*
     * A test function for various libraries. This one generates
     * uuids
     */
    public function uuid()
    {
        
        try {
            
            // Generate a version 1 (time-based) UUID
            $uuid1 = Uuid::uuid1();
            echoPRE('Time based' . $uuid1 . "\n"); // e4eaaaf2-d142-11e1-b3e4-080027620cdd
            
            // Generate a version 3 (name-based and hashed with MD5) UUID
            $uuid3 = Uuid::uuid3(Uuid::NAMESPACE_DNS, 'php.net');
            echoPRE($uuid3) . "\n"; // 11a38b9a-b3da-360f-9353-a5a725514269
            
            // Generate a version 4 (random) UUID
            $uuid4 = Uuid::uuid4();
            echoPRE($uuid4) . "\n"; // 25769c6c-d34d-4bfe-ba98-e0ee856f3e7a
            
            // Generate a version 5 (name-based and hashed with SHA1) UUID
            $uuid5 = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'php.net');
            echoPRE($uuid5) . "\n"; // c4a760a8-dbcf-5254-a0d9-6a4474bd1b62
            
        }
        catch (UnsatisfiedDependencyException $e) {
            
            // Some dependency was not met. Either the method cannot be called on a
            // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
            echo 'Caught exception: ' . $e->getMessage() . "\n";
            
        }
        
        
    }
    
    // Sample to use the AWS SDK libraries
    // These are loaded via Composer
    public function sample()
    {
        
        /*
        If you instantiate a new client for Amazon Simple Storage Service (S3) with
        no parameters or configuration, the AWS SDK for PHP will look for access keys
        in the AWS_ACCESS_KEY_ID and AWS_SECRET_KEY environment variables.
        For more information about this interface to Amazon S3, see:
        http://docs.aws.amazon.com/aws-sdk-php-2/guide/latest/service-s3.html#creating-a-client
        */
        $client = S3Client::factory(array(
            'key' => 'AKIAIPRLYMWDBDLZ5UJA',
            'secret' => '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'
            
        ));
        
        /*
        Everything uploaded to Amazon S3 must belong to a bucket. These buckets are
        in the global namespace, and must have a unique name.
        
        For more information about bucket name restrictions, see:
        http://docs.aws.amazon.com/AmazonS3/latest/dev/BucketRestrictions.html
        */
        $bucket = uniqid("php-sdk-sample-", true);
        echo "Creating bucket named {$bucket}\n";
        $result = $client->createBucket(array(
            'Bucket' => $bucket
        ));
        
        // Wait until the bucket is created
        $client->waitUntilBucketExists(array(
            'Bucket' => $bucket
        ));
        
        /*
        Files in Amazon S3 are called "objects" and are stored in buckets. A specific
        object is referred to by its key (i.e., name) and holds data. Here, we create
        a new object with the key "hello_world.txt" and content "Hello World!".
        
        For a detailed list of putObject's parameters, see:
        http://docs.aws.amazon.com/aws-sdk-php-2/latest/class-Aws.S3.S3Client.html#_putObject
        */
        $key = 'hello_world.txt';
        echo "Creating a new object with key {$key}\n";
        $result = $client->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'Body' => "Hello World!"
        ));
        
        /*
        Download the object and read the body directly.
        
        For more examples of downloading objects, see the developer guide:
        http://docs.aws.amazon.com/aws-sdk-php-2/guide/latest/service-s3.html#downloading-objects
        
        Or the API documentation:
        http://docs.aws.amazon.com/aws-sdk-php-2/latest/class-Aws.S3.S3Client.html#_getObject
        */
        echo "Downloading that same object:\n";
        $result = $client->getObject(array(
            'Bucket' => $bucket,
            'Key' => $key
        ));
        
        echo "\n---BEGIN---\n";
        echo $result['Body'];
        echo "\n---END---\n\n";
        
        /*
        Buckets cannot be deleted unless they're empty. With the AWS SDK for PHP, you
        have two options:
        
        - Use the clearBucket helper:
        http://docs.aws.amazon.com/aws-sdk-php-2/latest/class-Aws.S3.S3Client.html#_clearBucket
        - Or individually delete all objects.
        
        Since this sample created a new unique bucket and uploaded a single object,
        we'll just delete that object.
        */
        echo "Deleting object with key {$key}\n";
        $result = $client->deleteObject(array(
            'Bucket' => $bucket,
            'Key' => $key
        ));
        
        /*
        Now that the bucket is empty, it can be deleted.
        
        See the API documentation for more information on deleteBucket:
        http://docs.aws.amazon.com/aws-sdk-php-2/latest/class-Aws.S3.S3Client.html#_deleteBucket
        */
        echo "Deleting bucket {$bucket}\n";
        $result = $client->deleteBucket(array(
            'Bucket' => $bucket
        ));
        $result = $client->listBuckets(array());
        echo_array($result);
    }
}