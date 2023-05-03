<?php include "partials/_header.php"; ?>
    <section class="bg-dark">

        <div class="container pt-4 pt-xl-5">
            <h1>Formula Parser</h1>
            
            <h5>Preview</h5>
            
            <div class="formula-preview">
                
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-striped table-hover" id="formula-table">
                    <thead>
                        <tr>
                            <th>Content</th>
                            <th>Type</th>     
                            <th>Action</th>                       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                            
                            <td colspan="2">
                                <input type="text" class="form-control" id="content" name="content" placeholder="Content" >
                            </td>            
                            <td>
                                <button type="button" class="btn btn-primary" id="add-row">Add</button>
                            </td>
                        </tr>
                    </tbody>                                                
                </table>
            </div>

            <!-- Send -->
            <button type="button" class="btn btn-success" onclick="sendFormula()">Send</button>

        </div>

    </section>
<?php include "partials/_footer.php"; ?>

<script>

    let bracket = ['(', ')'];
    let operator = ['+', '-', '*', '/', '%', '^', '==', '!=', '>', '<', '>=', '<='];
    let logical = ['and', 'or', 'not', 'if', 'then', 'else'];    

    // Delete row
    $(document).on('click', '#delete-row', function() {
        $(this).closest('tr').remove();

        previewFormula();
    });

    // Add row
    $(document).on('click', '#add-row', function() {        
        var content = $('#content').val();        
        var type = '';

        if (content == '') {
            alert('Content is required');
            return false;
        }

        // Check if content more than 1 character
        if (content.length > 1) {

            // split content to array
            var contentArr = content.split(' ');

            // Loop Check if content is bracket
            for (var i = 0; i < contentArr.length; i++) {
                if (bracket.includes(contentArr[i])) {
                    type = 'bracket';
                } else if (operator.includes(contentArr[i])) {
                    type = 'operator';
                } else if (logical.includes(contentArr[i].toLowerCase())) {
                    type = 'logical';        
                } else if (!isNaN(contentArr[i])) {
                    type = 'value';        
                } else if (contentArr[i].match(/^[a-zA-Z]+$/)) {
                    type = 'variable';        
                } else {
                    alert('Invalid content');
                    return false;
                }

                var html = '<tr>';
                html += '<td>' + contentArr[i] + '</td>';
                html += '<td>' + type + '</td>';
                html += '<td>';
                html += '<button type="button" class="btn btn-danger" id="delete-row">Delete</button>';
                html += '</td>';
                html += '</tr>';

                $('#formula-table tbody').append(html);
            }

            previewFormula();

            $('#content').val('');
            
        } else {
            // Check if content is bracket
            if (bracket.includes(content)) {
            type = 'bracket';
            } else if (operator.includes(content)) {
            type = 'operator';
            } else if (logical.includes(content.toLowerCase())) {
            type = 'logical';        
            } else if (!isNaN(content)) {
            type = 'value';        
            } else if (content.match(/^[a-zA-Z]+$/)) {
            type = 'variable';        
            } else {
                alert('Invalid content');
                return false;
            }

            var html = '<tr>';        
            html += '<td>' + content + '</td>';
            html += '<td>' + type + '</td>';
            html += '<td>';
            html += '<button type="button" class="btn btn-danger" id="delete-row">Delete</button>';
            html += '</td>';
            html += '</tr>';

            $('#formula-table tbody').append(html);

            previewFormula();

            $('#content').val('');
        }
    });


    function previewFormula() {
        var formula = '';
        $('#formula-table tbody tr').each(function() {
            var content = $(this).find('td').eq(0).text();
            var type = $(this).find('td').eq(1).text();
            formula += content + ' ';
        });

        $('.formula-preview').html(formula);
    }

    function sendFormula() {
        var contentArr = [];
        var typeArr = [];

        // Each without first row
        $('#formula-table tbody tr').slice(1).each(function() {
            var content = $(this).find('td').eq(0).text();
            var type = $(this).find('td').eq(1).text();
            contentArr.push(content);
            typeArr.push(type);
        });

        console.log(contentArr);
        console.log(typeArr);
    }
    

</script>