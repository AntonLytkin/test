<?php
if($this->error)
    echo $this->error.' : '.$this->name;
else
    echo 'Пользователь с именем '.$this->name.' - '.$this->list[$this->name];