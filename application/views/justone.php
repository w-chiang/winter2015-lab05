<div class="row">
    <p>
        File: {filename}</br>
        Delivery Type: {type}</br>
        Customer Name: {customer}</br>   
        Special Instructions: {special} </br>
    </p>
    
    <p> Order Total: <b>${ordertotal}</b> </p>
    
    <p>Order Details:</p>
    
    <ul>
    {burgers}
    <li>
        Burger subtotal: ${subtotal}
        <br/>Patty: {patty}
        <br/>Cheeses: Top: {topcheese}. Bottom: {bottomcheese}
        <br/>Toppings: {toppings} {type} {/toppings} 
        <br/>Sauces: {sauces} {type} {/sauces}
    </li>
    {/burgers}
    
    </ol>
    </ul>
    
</div>