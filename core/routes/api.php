<?php

// Get array of submodules, if any.
$submodules = submodules("Pluma", $lookInCore = true);

include_files($submodules, "routes/api.php");
