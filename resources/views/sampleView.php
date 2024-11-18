{{ foreach ($var as $value) : }}
    {{ var_dump($value); }}
{{ endforeach }}
<form action=/invoices/create method="post"><label>Amount</label> <input type="text" name="amount"> <input type="submit"> </form>