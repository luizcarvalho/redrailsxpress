<?php
/*
Template Name: Calculator
*/
?>
<?php get_header(); ?>
<div id="main_content" class="grid_8">


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h2><?php the_title(); ?></h2><br/>
	
				<?php the_content(__('Read more'));?><div style="clear:both;"></div>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
		<script language="JavaScript">
<!--
function checkForZero(field)
{
    if (field.value == 0 || field.value.length == 0) {
        alert ("This field can't be 0!");
        field.focus(); }
    else
        calculatePayment(field.form);
}

function cmdCalc_Click(form)
{
    if (form.price.value == 0 || form.price.value.length == 0) {
        alert ("The Price field can't be 0!");
        form.price.focus(); }
    else if (form.ir.value == 0 || form.ir.value.length == 0) {
        alert ("The Interest Rate field can't be 0!");
        form.ir.focus(); }
    else if (form.term.value == 0 || form.term.value.length == 0) {
        alert ("The Term field can't be 0!");
        form.term.focus(); }
    else
        calculatePayment(form);
}

function calculatePayment(form)
{
    princ = form.price.value - form.dp.value;
    intRate = (form.ir.value/100) / 12;
    months = form.term.value * 12;
    form.pmt.value = Math.floor((princ*intRate)/(1-Math.pow(1+intRate,(-1*months)))*100)/100;
    form.principle.value = princ;
    form.payments.value = months;
}
//-->
</script>
      <script language="JavaScript">
<!--
function checkForZero(field)
{
    if (field.value == 0 || field.value.length == 0) {
        }
    else
        calculatePayment(field.form);
}

function cmdCalc_Click(form)
{
    if (form.price.value == 0 || form.price.value.length == 0) {
        alert ("The Price field can't be 0!");
        form.price.focus(); }
    else if (form.ir.value == 0 || form.ir.value.length == 0) {
        alert ("The Interest Rate field can't be 0!");
        form.ir.focus(); }
    else if (form.term.value == 0 || form.term.value.length == 0) {
        alert ("The Term field can't be 0!");
        form.term.focus(); }
    else
        calculatePayment(form);
}

function calculatePayment(form)
{
    princ = form.price.value - form.dp.value;
    intRate = (form.ir.value/100) / 12;
    months = form.term.value * 12;
    form.pmt.value = Math.floor((princ*intRate)/(1-Math.pow(1+intRate,(-1*months)))*100)/100;
    form.principle.value = princ;
    form.payments.value = months;
}
//-->
      </script>

    <form name="Loan Calculator" class="calc">
    <table width="99%" border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td  valign="top">
          <table border="0" align="right" cellpadding="2" bgcolor="#FFFFFF">
 
              <tr>
                <td colspan="2" align="middle"><h2 align="left">Finance Calculator </h2>
                  </td>
              </tr>
              <tr>
                <td width="52%"><table border="0"
                    cellpadding="2">
                    <tr>
                      <td colspan="2"><b>Fill-in Your  Loan Info - Numbers Only</b></td>
                    </tr>
                    <tr bgcolor="#FFFFCC">
                      <td width="126" align="right" bgcolor="#EFEEEE"> Purchase Price $</td>
                      <td width="149" bgcolor="#EFEEEE"><div align="left">
                          <input type="text" size="10"
                            name="price" value="0"
                            onBlur="checkForZero(this)"
                            onChange="checkForZero(this)">
                      </div></td>
                    </tr>
                    <tr bgcolor="#FFFFCC">
                      <td align="right" bgcolor="#EFEEEE">Down Payment $</td>
                      <td bgcolor="#EFEEEE"><div align="left">
                          <input type="text" size="10"
                            name="dp" value="0"  
                            onChange="calculatePayment(this.form)">
                      </div></td>
                    </tr>
                    <tr bgcolor="#FFFFCC">
                      <td align="right" bgcolor="#EFEEEE">Annual Interest Rate:</td>
                      <td bgcolor="#EFEEEE"><div align="left">
                          <input type="text" size="5"
                            name="ir" value="0"
                            onBlur="checkForZero(this)"
                            onChange="checkForZero(this)">
                          % </div></td>
                    </tr>
                    <tr bgcolor="#FFFFCC">
                      <td align="right" bgcolor="#EFEEEE">Loan Term:</td>
                      <td bgcolor="#EFEEEE"><div align="left">
                          <input type="text" size="4"
                            name="term" value="30"
                            onBlur="checkForZero(this)"
                            onChange="checkForZero(this)">
                         Yrs.</div></td>
                    </tr>
                </table></td>
                <td width="48%" valign="top"><table border="0" cellpadding="2">
                    <tbody>
                      <tr>
                        <td colspan="2"><strong>Your Results:</strong></td>
                      </tr>
                      <tr>
                        <td width="126" align="right" bgcolor="#E0E8F5"> Principal: $ </td>
                        <td width="122" bgcolor="#E0E8F5"><div align="left">
                          <input type="label" size="12"
                            name="principle">
                        </div></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#E0E8F5">Total Payments:</td>
                        <td bgcolor="#E0E8F5"><div align="left"> 
                            <input type="label" size="12"
                            name="payments">
                        </div></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#E0E8F5">Monthly Payment: $</td>
                        <td bgcolor="#E0E8F5"><div align="left">
                          <input type="label" size="12"
                            name="pmt">
                        </div></td>
                      </tr>
                      <tr>
                        <td colspan="2" align="right">&nbsp;</td>
                      </tr>
                    </tbody>
                </table></td>
              </tr>
              <tr>
                <td>
                  <div align="center">
                    <input
                    type="button" name="cmdCalc"
                    value="Calculate"
                    onClick="cmdCalc_Click(this.form)">
                      </div></td>
                <td valign="top"><div align="center"></div></td>
              </tr>
              <tr>
                <td colspan="2"><div align="center">
            
                  </div></td>
              </tr>
          </table>
  
      </form></td>
    </tr>
  </tbody>
</table>	


</div><!-- end main_content grid_8 -->
<div id="sidebar" class="grid_4 omega">
<?php get_sidebar();?>
</div><!-- end sidebar-->
<?php get_footer();?>