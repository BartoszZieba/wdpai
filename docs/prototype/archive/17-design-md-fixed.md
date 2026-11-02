# DESIGN.md — poprawione tokeny

Podmień **front matter** w `warm_academic_paper_ink/DESIGN.md` na poniższy.
Proza może zostać, ale warto dopisać w niej, że nagłówki to **Fraunces**.

```yaml
---
name: Warm Academic Paper & Ink
colors:
  surface: '#FBF8F3'
  surface-dim: '#E9E2D6'
  surface-bright: '#FBF8F3'
  surface-container-lowest: '#FFFFFF'
  surface-container-low: '#F3EEE6'
  surface-container: '#F3EEE6'
  surface-container-high: '#EDE6DA'
  surface-container-highest: '#E4DED3'
  on-surface: '#14213D'
  on-surface-variant: '#5C6675'
  inverse-surface: '#14213D'
  inverse-on-surface: '#FBF8F3'
  outline: '#CFC6B8'
  outline-variant: '#E4DED3'
  surface-tint: '#1F5F5B'
  primary: '#174A47'
  on-primary: '#FFFFFF'
  primary-container: '#1F5F5B'
  on-primary-container: '#FFFFFF'
  inverse-primary: '#E3F0ED'
  primary-fixed: '#E3F0ED'
  primary-fixed-dim: '#CFE5DF'
  on-primary-fixed: '#14213D'
  on-primary-fixed-variant: '#174A47'
  secondary: '#B54708'
  on-secondary: '#FFFFFF'
  secondary-container: '#E8A33D'
  on-secondary-container: '#14213D'
  secondary-fixed: '#FBEBD2'
  secondary-fixed-dim: '#E8A33D'
  on-secondary-fixed: '#14213D'
  on-secondary-fixed-variant: '#B54708'
  tertiary: '#14213D'
  on-tertiary: '#FFFFFF'
  tertiary-container: '#14213D'
  on-tertiary-container: '#FBF8F3'
  tertiary-fixed: '#F3EEE6'
  tertiary-fixed-dim: '#E4DED3'
  on-tertiary-fixed: '#14213D'
  on-tertiary-fixed-variant: '#5C6675'
  error: '#B42318'
  on-error: '#FFFFFF'
  error-container: '#FDECEA'
  on-error-container: '#B42318'
  background: '#FBF8F3'
  on-background: '#14213D'
  surface-variant: '#F3EEE6'
typography:
  display:
    fontFamily: Fraunces
    fontSize: 48px
    fontWeight: '600'
    lineHeight: 56px
    letterSpacing: -0.02em
  display-mobile:
    fontFamily: Fraunces
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 38px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Fraunces
    fontSize: 36px
    fontWeight: '600'
    lineHeight: 44px
    letterSpacing: -0.015em
  headline-lg-mobile:
    fontFamily: Fraunces
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 34px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Fraunces
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Fraunces
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  title:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '600'
    lineHeight: 26px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 26px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 22px
  label-lg:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.02em
  label-caps:
    fontFamily: Inter
    fontSize: 11px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.06em
rounded:
  sm: 0.375rem
  DEFAULT: 0.5rem
  md: 0.625rem
  lg: 0.75rem
  xl: 1rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-sm: 1rem
  margin: 2rem
  margin-sm: 1rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2.5rem
---
```

## Co to zmienia

- tło strony i surface → ciepłe `#FBF8F3`,
- sekcje → `#F3EEE6`, karty → `#FFFFFF`,
- primary → `#1F5F5B` (z ciemniejszym hoverem `#174A47`),
- akcent → `#E8A33D` z tekstem `#14213D`,
- nagłówki → **Fraunces**, nie Newsreader,
- body 16/26, small 14/22.

## Ważne

To naprawi **przyszłe generacje** w Stitchu. Obecne S2–S5 nie zmienią się same — trzeba je **regenerować** (ryzyko utraty poprawek) albo **poprawić HTML** i złożyć PDF bez regeneracji.
