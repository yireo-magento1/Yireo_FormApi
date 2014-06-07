FormApi:

=== Form methods ===
$form = Mage::getSingleton('formapi/form');
$form->loadFile('test.xml');
$post = $form->getPostData(); // Merge POST-values plus validation
$valid = $form->validate($post);
$form->getErrors();

=== Fieldset methods ===
$fieldset = $form->getFieldset('basic');
$fields = $fieldset->getFields();

=== Field methods ===
$field = $form->getField('name');
$field->__toString(); // array-debug
$field->getValue();
$field->setValue($value);
$field->validate($value);

=== Features ===
- Form generation
- Form validation
- AJAX-selection of products
- CAPTCHA-integration
- Disable autocomplete
- Allow for cleaning-data (trim())

=== Types ===
- url
- search
- tel
- skype
- datetime
- twitter
- date
- month
- week
- time
- datetime-local
- number
- range
- color

=== DONE ===
<field type="text" name="example" label="Example" placeholder="Your example" required="1" />
<field type="text" name="example" label="Example" class="input-url" />
<field type="radio" name="example" label="Example" description="Do you want an example?" default="1">
    <option value="0">No</option>
    <option value="1">Yes</option>
</field>

=== TODO ===
<field type="input" name="website" validators="url" />