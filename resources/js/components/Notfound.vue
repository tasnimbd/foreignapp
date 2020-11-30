<template>
    <div>
        <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Nothing found</h3>

            </div>
            <div class="card-body">
            Not sure what are you looking for?
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            need help?
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        </section>
    </div>
</template>

<script>
export default {
    name:'Notfound',
    metaInfo() {
        return { 
            title: "404 Nothing Found",
            meta: [
                { name: 'description', content:  '404 Nothing Found'}

            ]
        }
    },

}
</script>