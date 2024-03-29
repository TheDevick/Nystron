import styled from "styled-components"
import Content from "./Content"
import Image from "./Image"

const AboutContainer = styled.div`
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;

    @media (min-width: 768px) {
        flex-direction: row;
    }

`

export default function About(props: any) {
    return (
        <AboutContainer id="Sobre">
            <Image />
            <Content {...props} />
        </AboutContainer>
    )
}