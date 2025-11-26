  public function executeListCsv(sfWebRequest $request)
  {
    $query = $this->buildQuery();
    $items = $query->execute();
    $headers = $this->configuration->getListExport();
    $export = new ExportCsv("export-".$this->getModuleName().".csv", array_values($headers));
    foreach ($items as $item) {
    	$line = array();
    	foreach($headers as $field) {
            $error = false;
    		try{
    		    if ($field[0] == '_') {
    		    	$field = substr($field, 1);
    		    }
    		    if ($field == 'ecrus') {
    			continue;
    		    }
    		    $line[$field] = $item->$field;
    		} catch (sfException $e) {
    		    $error = true;
      	        $line[$field] = null;
    		}

            if($error) {
                try{
                    $line[$field] = $item->{str_replace('_', '', $field)};
                } catch (sfException $e) {
                    $line[$field] = null;
                }
            }
    	}
    	$export->add($line);
    }
    $export->configureResponse($this->getResponse());
    return $this->renderText($export->output());
  }
