<?php


function computeMainData($buildBranches, $debugScript)

{

	global $buckets, $latestFile, $latestTimeStamp, $timeStamps;

	echo "ccc - we got here!";
	foreach ($buildBranches as $buildBranch ) {

		if (file_exists($buildBranch) && is_dir($buildBranch)) {
			$aDirectory = dir($buildBranch);
			$latestTimeStamp[$buildBranch] = array();
			$latestFile[$buildBranch] = array();


			while (false !== ($anEntry = $aDirectory->read())) {

				// Short cut because we know aDirectory only contains other directories.
				if ($anEntry != "." && $anEntry!="..") {

					// echo "Debug anEntry: $anEntry<br />" ;
					$aDropDirectoryName = $buildBranch."/".$anEntry;


					if (is_dir($aDropDirectoryName) && is_Readable($aDropDirectoryName)) {
						$aDropDirectory = dir($aDropDirectoryName);
						//echo "Debug aDropDirectory: $aDropDirectory->path <br />" ;

						$fileCount = 0;
						while ($aDropEntry = $aDropDirectory->read()) {
							// echo "Debug aDropEntry: $aDropEntry<br />" ;
							if ( (stristr($aDropEntry, ".tar.gz")) || (stristr($aDropEntry, ".zip")) )  {
								// Count the dropfile entry in the directory (so we won't display links, if not all there
								$fileCount = $fileCount + 1;
							}
						}

						$aDropDirectory->close();

					}
					// Read the count file
					$countFile = $buildBranch."/".$anEntry."/files.count";
					$indexFile = $buildBranch."/".$anEntry."/index.html";


					if (!file_exists($indexFile)) {
						$indexFile = $buildBranch."/".$anEntry."/index.php";
					}


					if (file_exists($countFile) && file_exists($indexFile)) {
						$anArray = file($countFile);
						// echo "Debug: Number according to files.count: ", $anArray[0], "<br />";
						// echo "Debug:    actual counted files: ", $fileCount, "<br />";

						// If a match - process the directoryVV -- we simply look that there's more
						// zip's than we expect, since it frequently breaks where the count is slighly
						// off, such as when we add, after the fact, an all-in-one zip.
						if ($anArray[0] <= $fileCount) {
							// debug
							//echo "yes, counted equaled expected count<br />";

							$artifactTimeStamp="";
							$entryParts = explode("-", $anEntry);
							if (count($entryParts) == 3) {
								include 'processDropDirectory.php';
							}

						}
					}

				}
			}

			$aDirectory->close();
		}}
}
?>
