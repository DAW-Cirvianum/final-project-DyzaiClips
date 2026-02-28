import { useState, useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function Register() {
    const [name, setName] = useState('')
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [passwordConfirmation, setPasswordConfirmation] = useState('')
    const [errors, setErrors] = useState({})
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
        setErrors({})

        // VALIDACIÓ AL CLIENT
        const clientErrors = {}
        if (!name.trim()) clientErrors.name = ['El nom és obligatori']
        if (!email.trim()) clientErrors.email = ['L’email és obligatori']
        else if (!/\S+@\S+\.\S+/.test(email)) clientErrors.email = ['Email no vàlid']
        if (!password) clientErrors.password = ['La contrasenya és obligatòria']
        else if (password.length < 6) clientErrors.password = ['La contrasenya ha de tenir almenys 6 caràcters']
        if (password !== passwordConfirmation) clientErrors.password_confirmation = ['Les contrasenyes no coincideixen']

        if (Object.keys(clientErrors).length) {
            setErrors(clientErrors)
            return
        }

        try {
            await api.post('/register', {
                name,
                email,
                password,
                password_confirmation: passwordConfirmation,
            })

            // Redirigir al login després del registre
            navigate('/login')

        } catch (err) {
            console.error(err)
            // Maneig d'errors del servidor
            if (err.response) {
                switch (err.response.status) {
                    case 422:
                        // Laravel retorna errors de validació
                        setErrors(err.response.data.errors)
                        break
                    default:
                        setErrors({ general: ['S’ha produït un error al servidor'] })
                }
            } else {
                setErrors({ general: ['No s’ha pogut connectar amb el servidor'] })
            }
        }
    }

    return (
        <div className="auth-container">
            <h2>Register</h2>

            {errors.general && <p className="error">{errors.general[0]}</p>}

            <form onSubmit={handleSubmit} className="auth-form">

                {/* Name */}
                <div>
                    <input
                        type="text"
                        placeholder="Name"
                        value={name}
                        onChange={e => setName(e.target.value)}
                        required
                    />
                    <small>Required. Your public username.</small>
                    {errors.name && <p className="error">{errors.name[0]}</p>}
                </div>

                {/* Email */}
                <div>
                    <input
                        type="email"
                        placeholder="Email"
                        value={email}
                        onChange={e => setEmail(e.target.value)}
                        required
                    />
                    <small>Must be a valid and unique email address.</small>
                    {errors.email && <p className="error">{errors.email[0]}</p>}
                </div>

                {/* Password */}
                <div>
                    <input
                        type="password"
                        placeholder="Password"
                        value={password}
                        onChange={e => setPassword(e.target.value)}
                        required
                    />
                    <small>Minimum 6 characters.</small>
                    {errors.password && <p className="error">{errors.password[0]}</p>}
                </div>

                {/* Password confirmation */}
                <div>
                    <input
                        type="password"
                        placeholder="Confirm password"
                        value={passwordConfirmation}
                        onChange={e => setPasswordConfirmation(e.target.value)}
                        required
                    />
                    <small>Must match the password.</small>
                    {errors.password_confirmation && <p className="error">{errors.password_confirmation[0]}</p>}
                </div>

                <button type="submit">Register</button>
            </form>
        </div>
    )
}

export default Register

