<style>
    textarea.textoarea:first-line { font-weight: bold; }
    .pagination a {
        margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
    }
    hr { 
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }
    .result
    {
        position: absolute;
        z-index: 1;
        width:500px;
        padding:10px;
        display:none;
        margin-top:-1px;
        border-top:0px;
        overflow:hidden;
        border:1px #CCC solid;
        background-color: white;
    }
    .show
    {
        padding:10px;
        border-bottom:1px solid #000000;
        font-size:15px; 
        height:50px;
    }
    .show:hover
    {
        background:#4c66a4;
        color:#FFF;
        cursor:pointer;
    }

    .showhover
    {
        background:#4c66a4;
        color:#FFF;
    }
</style>