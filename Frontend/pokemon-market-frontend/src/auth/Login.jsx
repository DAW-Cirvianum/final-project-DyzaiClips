import { useState, useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function Login({ setToken }) {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [error, setError] = useState('')
    const navigate = useNavigate()

    // Redirigir si l'usuari ja està loguejat
    useEffect(() => {
        const token = localStorage.getItem('token')
        if (token) {
            navigate('/products')
        }
    }, [navigate])

    const handleSubmit = async (e) => {
        e.preventDefault()
        setError('')

        // VALIDACIÓ AL CLIENT
        if (!email || !password) {
            setError('Tots els camps són obligatoris')
            return
        }
        if (!/\S+@\S+\.\S+/.test(email)) {
            setError('Email no és vàlid')
            return
        }
        if (password.length < 6) {
            setError('La contrasenya ha de tenir almenys 6 caràcters')
            return
        }

        try {
            const response = await api.post('/login', { email, password })

            // DEBUG: pots treure després
            console.log('Login response:', response.data)

            const token = response.data.token
            const role = response.data.role

            if (!token || !role) {
                throw new Error('Token o rol no retornat pel servidor')
            }

            // Guardar token i rol
            localStorage.setItem('token', token)
            localStorage.setItem('role', role)
            setToken(token)

            // Redirigir a la pàgina de products
            navigate('/products')

        } catch (err) {
            console.error(err)

            // VALIDACIÓ D'ERROR DEL SERVIDOR
            if (err.response) {
                switch (err.response.status) {
                    case 401:
                        setError('Credencials incorrectes')
                        break
                    case 403:
                        setError('Verifica el teu email abans d’iniciar sessió')
                        break
                    case 422:
                        setError('Hi ha errors amb les dades enviades')
                        break
                    default:
                        setError('S’ha produït un error al servidor')
                }
            } else {
                setError('No s’ha pogut connectar amb el servidor')
            }
        }
    }

    return (
        <div className="auth-container">
            <h2>Login</h2>

            {error && <p className="error">{error}</p>}

            <form onSubmit={handleSubmit} className="auth-form">
                <input
                    type="email"
                    placeholder="Email"
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                    required
                />

                <input
                    type="password"
                    placeholder="Password"
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                    required
                />

                <button type="submit">Login</button>
            </form>

            <p>
                No tens compte? <a href="/register">Registra’t</a>
            </p>
        </div>
    )
}

export default Login
