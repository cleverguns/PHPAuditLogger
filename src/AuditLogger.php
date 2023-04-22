class AuditLogger {
  private $driver;
  
  public function __construct($driverType, $config) {
    // Check the driver type and create an instance of the appropriate driver
    switch ($driverType) {
      case 'file':
        $this->driver = new FileLoggingDriver($config['filename']);
        break;
      case 'database':
        $this->driver = new DatabaseLoggingDriver($config['dsn'], $config['username'], $config['password']);
        break;
      case 'email':
        $this->driver = new EmailLoggingDriver($config['to'], $config['from']);
        break;
      default:
        throw new Exception('Invalid logging driver type');
    }
  }
  
  // Other methods in the AuditLogger class...
}

class EmailLoggingDriver {
  private $to;
  private $from;
  
  public function __construct($to, $from) {
    $this->to = $to;
    $this->from = $from;
  }
  
  public function log($message) {
    // Send an email with the log message to the specified recipient
    $subject = 'Audit log message';
    $headers = "From: $this->from\r\n";
    $body = $message;
    
    mail($this->to, $subject, $body, $headers);
  }
}

