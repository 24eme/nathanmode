  public function executeListCsv(sfWebRequest $request)
  {
    $query = $this->buildQuery();
    $items = $query->execute();
    $headers = $this->configuration->getListDisplay();
    $export = new ExportCsv("export-".$this->getModuleName().".csv", array_values($headers));
    foreach ($items as $item) {
    	$line = array();
    	foreach($headers as $field) {
    		try{
    		    if ($field[0] == '_') {
    		    	$field = substr($field, 1);
    		    }
		    if ($field == 'ecrus') {
			continue;
		    }
    		    $line[$field] = $item->$field;
    		} catch (sfException $e) {
    			$line[$field] = null;
    		}
    	}
    	$export->add($line);
    }
    $export->configureResponse($this->getResponse());
    return $this->renderText($export->output());
  }
