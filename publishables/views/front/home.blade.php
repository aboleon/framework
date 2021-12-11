<x-front-layout>
    @push('css')
        <style>
            div.holder {
                position: absolute;top: 50%;left: 50%;
                transform:translate(-50%,-50%);
                text-align: center;
                font-family: 'Nunito', sans-serif;
            }
            h1 {
                font-size: 65px;
                margin: 0;
            }
            a  {
                text-decoration: none;
                color: #03a9f4;
            }
        </style>
    @endpush
    <div class="holder">
        <h1>Now code !</h1>
        <a href="{{ route('login') }}">Here for the Back Office</a>
    </div>

</x-front-layout>
