<?php

$newline = "\r\n";
echo $message->getSubject() . $newline . $newline;

foreach ($form->getElements() as $element) {
    if (!$element->isHidden()) {
        echo $element->getLabel() . $newline;
        echo '------------------------' . $newline;
        $value = $element->getValue();
        if (is_scalar($value)) {
            echo $value . $newline;
        } elseif (is_array($value)) {
            foreach ($value as $val) {
                if (is_scalar($val)) {
                    echo $val . $newline;
                }
            }
        }
    }

    echo $newline . $newline;
}