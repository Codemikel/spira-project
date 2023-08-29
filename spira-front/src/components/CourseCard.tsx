import { useEffect, useState } from "react";
import axios from "axios";

function CourseCard() {
    const [courseData, setCourseData] = useState({});

    useEffect(() => {
        
        axios.get("http://localhost:8000/api/student")
            .then(response => {
                
                setCourseData(response.data);
            })
            .catch(error => {
                console.error("Error al obtener los datos:", error);
            });
    }, []);

    return (
        <>
            <div className={'bg-green'}>
                <h2>Nombre de clase: {courseData.className}</h2>
                <p>Horas: {courseData.hours}</p>
            </div>
        </>
    )
}

export default CourseCard;
