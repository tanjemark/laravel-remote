<?php

namespace Anjemark\Remote\Traits;

use Exception;

trait SSHable
{
    public $channel;
    public $connection;

    /**
     * Connect to the server.
     *
     * @return void
     */
    public function connect($channel)
    {
        $channel = str_replace('@', '', $channel);

        if (!config("remote.channels.$channel")) {
            $this->error("@$channel not found!");
            exit();
        }
        
        $ip = config("remote.channels.$channel.ip");

        try {
            $connection = ssh2_connect(
                $ip,
                config("remote.channels.$channel.port"),
                ['hostkey' => 'ssh-rsa']
            );
        } catch (Exception $e) {
            $this->error("Failed to connect to $ip");
            exit();
        }

        $this->channel = $channel;
        $this->connection = $connection;
        
        $authenticated = static::authenticate($connection, $channel);

        $this->info("Connected to $ip");

        return $authenticated;
    }

    /**
     * Authenticate by password or SSH keys.
     *
     * @return void
     */
    protected static function authenticate($connection, $channel)
    {
        try {
            if (config("remote.channels.$channel.password")) {
                $auth = ssh2_auth_password(
                    $connection,
                    config("remote.channels.$channel.username"),
                    'vagrant'
                );
            } else {
                $auth = ssh2_auth_pubkey_file(
                    $connection,
                    config("remote.channels.$channel.username"),
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
        $this->info("Start running $cmd");

        $path = config("remote.channels.$this->channel.path");
        $cmd = $path ? 'cd ' . config("remote.channels.{$this->channel}.path") . ' && ' . $cmd : $cmd;

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
        $ip = config("remote.channels.$this->channel.ip");

        $this->info("Disconnecting from $ip");
        ssh2_disconnect($this->connection);
    }
}
