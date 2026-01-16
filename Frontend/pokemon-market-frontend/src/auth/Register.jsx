import { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import api from '../api/axios'

function Register() {
    const [name, setName] = useState('')
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [passwordConfirmation, setPasswordConfirmation] = useState('')
    const [errors, setErrors] = useState({})
    const navigate = useNavigate()

    /**
     * Handle register form submission
     */
    const handleSubmit = async (e) => {
        e.preventDefault()
        setErrors({})

        try {
            await api.post('/register', {
                name,
                email,
                password,
                password_confirmation: passwordConfirmation,
            })

            navigate('/login')
        } catch (err) {
            if (err.response && err.response.status === 422) {
                setErrors(err.response.data.errors)
            } else {
                setErrors({ general: ['Registration failed'] })
            }
        }
    }

    return (
        <div className="auth-container">
            <h2>Register</h2>

            {errors.general && (
                <p className="error">{errors.general[0]}</p>
            )}

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
                </div>

                <button type="submit">Register</button>
            </form>
        </div>
    )
}

export default Register

