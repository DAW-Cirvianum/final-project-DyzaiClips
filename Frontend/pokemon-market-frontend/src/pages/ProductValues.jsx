import { useEffect, useState } from 'react'
import { useParams } from 'react-router-dom'
import api from '../api/axios'

function ProductValues() {
    const { id } = useParams()
    const [values, setValues] = useState([])
    const [message, setMessage] = useState('')

    useEffect(() => {
        api.get(`/product-values?product_id=${id}`)
            .then(res => setValues(res.data))
    }, [id])

    /**
     * Buy a product value
     */
    const buy = async (productValueId) => {
        try {
            await api.post('/transactions', {
                product_value_id: productValueId
            })

            setMessage('Purchase completed successfully')

            // Update stock visually
            setValues(values.map(v =>
                v.id === productValueId
                    ? { ...v, stock: v.stock - 1 }
                    : v
            ))

        } catch (error) {
            setMessage('Error while purchasing')
        }
    }

    return (
        <div className="page-container">
            <h2>Available prices</h2>

            {message && <p>{message}</p>}

            <div className="price-list">
                {values.map(v => (
                    <div key={v.id} className="price-card">
                        <h4>{v.product.name}</h4>

                        <p><strong>Condition:</strong> {v.condition}</p>
                        <p><strong>Price:</strong> €{v.price}</p>
                        <p><strong>Stock:</strong> {v.stock}</p>

                        <button
                            className="product-btn"
                            disabled={v.stock < 1}
                            onClick={() => buy(v.id)}
                        >
                            Buy
                        </button>
                    </div>
                ))}
            </div>
        </div>
    )
}

export default ProductValues

