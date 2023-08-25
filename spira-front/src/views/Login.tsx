import React, {useEffect, useState} from "react";
import axios from "axios";



function Login() {

    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');
    const [data, setData] = useState<string[]>([]);

    function handleSubmit(event:any): void{
        event.preventDefault();
        authLogin(email, password)
    }

    function getEmail(event:any): void{
        setEmail(event.target.value)
    }

    function getPassword(event:any): void{
        setPassword(event.target.value)
    }

    let URL = 'http://localhost:8000/api/login'


    function authLogin(email:string, password:string): void {
        axios({
            method:"post",
            url:URL,
            data:{
                email:email,
                password:password,
            }
        }).then(response => {
            setData(response.data)
        })
    }

    return (
        <>
            <form onSubmit={handleSubmit} className={'container-lg w-100 d-flex flex-column gap-4'}>
                <label htmlFor="" className={'d-flex flex-column gap-2'}>
                    <span>Email</span>
                    <input type="email" onChange={getEmail} name="email" id="" />
                </label>
                <label htmlFor="" className={'d-flex flex-column gap-2'}>
                    <span>Contraseña</span>
                    <input type="password" onChange={getPassword} name="password" id="" />
                </label>
                <button type="submit">Ingresar</button>
            </form>
        </>
    )
}

export default Login;