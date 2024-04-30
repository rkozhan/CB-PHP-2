<form action="" method="post" class="flex flex-wrap gap-4 items-stretch justify-center py-4 mb-9">

    <div class="max-w-xs flex flex-col gap-3">
        <input type="hidden" name="customer_id" value="<?= isset($customer['company_id']) ? $customer['company_id'] : '' ?>">
        
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" value="<?= isset($customer['company_name']) ? $customer['company_name'] : '' ?>" required>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" value="<?= isset($customer['contact_person']) ? $customer['contact_person'] : '' ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?= isset($customer['phone']) ? $customer['phone'] : '' ?>" required>
    </div>

    <div class="max-w-xs flex flex-col gap-3">
        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" class="resize-none"><?= isset($customer['address']) ? $customer['address'] : '' ?></textarea>
        
        <input type="submit" class="bg-teal-700 px-2 py-1 hover:bg-teal-600 text-white" value="<?= $submit_label?>">
    </div>

    
</form>