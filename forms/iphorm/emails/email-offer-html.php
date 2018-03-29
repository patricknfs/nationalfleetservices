<html>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td valign="top" style="padding: 25px;"><table width="600" cellpadding="0" cellspacing="0" border="0" style="font: 14px Helvetica, Arial, sans-serif;">
            <tr>
                <td valign="top" style="font-family: Helvetica, Arial, sans-serif; font-size: 25px; font-weight: bold; color: #282828; padding-bottom: 10px;"><?php echo $form->escape($message->getSubject()); ?></td>
            </tr>
            <tr>
                <td valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <?php foreach ($form->getElements() as $element) : ?>
                        <?php if (!$element->isHidden()) : ?>
                            <tr>
                                <td valign="top" width="220px" style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: bold; color: #282828;"><?php echo $form->escape($element->getLabel())?></td>

                                <td valign="top" width="380px" style="font-family: Helvetica, Arial, sans-serif; color: #282828; line-height: 130%;">
                                    <?php $value = $element->getValue(); ?>
                                    <?php if (is_scalar($value)) : ?>
                                        <?php echo nl2br($form->escape((string) $value)); ?>
                                    <?php elseif (is_array($value)) : ?>
                                        <?php foreach ($value as $val) : ?>
                                            <?php if (is_scalar($val)) : ?>
                                                <?php echo nl2br($form->escape((string) $val)) . '<br />'; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table></td>
            </tr>
        </table></td>
    </tr>
</table>

<img src="<?php echo $form->getValue('pic'); ?>" />

</body>
</html>