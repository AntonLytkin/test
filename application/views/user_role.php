<?php
if($this->error)
    echo $this->error.' : '.$this->name;
else
    echo '������������ � ������ '.$this->name.' - '.$this->list[$this->name];