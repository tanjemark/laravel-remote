<?php

namespace Tanjemark\LaravelRemote\Traits;

use Exception;

trait SSHable
{
    public $alias;
    public $connection;

    /**
     * Connect to the server.
     *
     * @return void
     */
    public function connect($alias)
    {
        $alias = str_replace('@', '', $alias);

        if (!config("remote.servers.$alias")) {
            $this->error("@$alias not found!");
            exit();
        }
        
        try {
            $connection = ssh2_connect(
                config("remote.servers.$alias.ip"),
                config("remote.servers.$alias.port"),
                ['hostkey' => 'ssh-rsa']
            );
        } catch (Exception $e) {
            $this->error("Failed to connect to @$alias");
            exit();
        }

        $this->alias = $alias;
        $this->connection = $connection;
        
        $authenticated = static::authenticate($connection, $alias);

        $this->info("Connected to @$alias");

        return $authenticated;
    }

    /**
     * Authenticate by password or SSH keys.
     *
     * @return void
     */
    protected static function authenticate($connection, $alias)
    {
        try {
            if (config("remote.servers.$alias.password")) {
                $auth = ssh2_auth_password(
                    $connection,
                    config("remote.servers.$alias.username"),
                    'vagrant'
                );
            } else {
                $auth = ssh2_auth_pubkey_file(
                    $connection,
                    config("remote.servers.$alias.username"),
                    config("remote.ssh_paths.public"),
                    config("remote.ssh_paths.private")
                );
            }
        } catch (Exception $e) {
            exit();
        }
            
        return $connection;
    }

    /**
     * Execute command.
     *
     * @return string
     */
    public function command($cmd = '')
    {
        $path = config("remote.servers.$this->alias.path");
        $cmd = $path ? "cd $path && $cmd" : $cmd;

        $stream = ssh2_exec($this->connection, $cmd);
        stream_set_blocking($stream, true);

        return stream_get_contents($stream);
    }

    /**
     * Disconnect from the server.
     *
     * @return void
     */
    public function disconnect()
    {
        $this->info("Disconnecting from @$this->alias");
        ssh2_disconnect($this->connection);
    }
}
