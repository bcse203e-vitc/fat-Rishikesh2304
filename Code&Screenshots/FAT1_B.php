<?php
function lineSum(string $filename, int $lineNumber): int {
    if (!is_readable($filename)) {
        return 0;
    }
    $handle = fopen($filename, "r");
    if (!$handle) {
        return 0;
    }
    $current = 0;
    $result = 0;
    while (($line = fgets($handle)) !== false) {
        $current++;
        $trimmed = trim($line);
        if ($trimmed === "" || str_starts_with($trimmed, "#")) {
            continue;
        }
        if ($current === $lineNumber) {
            $tokens = preg_split('/\s+/', $trimmed);
            foreach ($tokens as $tok) {
            
                if (filter_var($tok, FILTER_VALIDATE_INT) !== false) {
                    $result += (int)$tok;
                }
            }
            fclose($handle);
            return $result;
        }
    }
    fclose($handle);
    return 0;
}
?>

