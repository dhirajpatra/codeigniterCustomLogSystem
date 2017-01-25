# codeigniterCustomLogSystem
this is very simple to implement to create custom log system for your codeigniter application

##Keep the MY_Log.php into /application/librarires/ folder
##Add this class to autoload.php
##update config.php
```$config['log_threshold'] = 3;
$config['exclude_logging'] = array(E_STRICT,E_NOTICE);
```


